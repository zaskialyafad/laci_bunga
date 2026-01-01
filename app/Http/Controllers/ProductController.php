<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


//import model 
use App\Models\Product; 
use App\Models\Category;
use App\Models\Product_variation;
use App\Models\Gambar_produk;

//import return type View
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() 
    {
        //ambil semua products
        $products = Product::with(['category', 'gambar_produk', 'product_variation'])->latest()->get();        
        return view ( 'project.view-data', compact('products'));
    }

    public function tambah()
    {
        // untuk panggil category agar bisa ditapilkan di dropdown
        $category = Category::all();
        return view('project.tambah', compact('category'));
    }

    public function simpanProduk(Request $request)
    {
        $request->validate([
            'product_name'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'description'=>'required|string',
            'image.*'=>'image|mimes:jpg,jpeg,png|max:2048',
            'price'=>'required_without:variations|numeric|min:0',
            'stock'=>'required_without:variations|integer|min:0',

            'variations.*.color'=> 'required_with:variations|string',
            'variations.*.size'=> 'required_with:variations|string',
            'variations.*.sku'=> 'required_with:variations|string',
            'variations.*.price' => 'required_with:variations|numeric|min:0',
            'variations.*.stock' => 'required_with:variations|integer|min:0',

        ]);

        DB::beginTransaction();

        try {
            $product = Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'status' => 'show'
             ]);  
             
             if ($request -> hasFile('image')){
                $images = $request->file('image');
                foreach ($images as $index => $image){
                    $filename = time() . '_' .$index . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('productsImg', $filename, 'public');
                    Gambar_produk::create([
                        'product_id' => $product->id,
                        'image' => $filename,
                        'is_primary' => $index === 0 ? 1 : 0,
                    ]);
                }
             } 

             if ($request->has('variations')) {
            foreach ($request->variations as $variation) {
                Product_variation::create([
                    'product_id' => $product->id,
                    'color' => $variation['color'],
                    'size'  => $variation['size'],
                    'sku'   => $variation['sku'],
                    'price' => $variation['price'],
                    'stock' => $variation['stock'],
                ]);
            }
        } else {
            // Jika tidak ada variasi (Produk Tunggal)
            $sku = 'SKU-'. strtoupper(Str::random(8));
            Product_variation::create([
                'product_id' => $product->id,
                'color' => null,
                'size' => null,
                'sku' => $sku,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);
        }


            DB::commit();
            return redirect()->route('project.view-data')->with('success','Product berhasil ditambahkan!');
        } catch (\Exception $e) {

         // rollback jika terjadi error
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Gagal simpan: ' . $e->getMessage());        }      
    }
    
    
    public function edit(Product $product)
    {
        // menampilkan detail produk yang akan di edit
        $product->load(['Category','Gambar_produk', 'Product_variation']);
        $categories = Category::all();
        return view ('project.edit', compact('product','categories'));
    }

    Public function editProduct(Request $request, Product $product)
    {
        $request->validate([
            'product_name'=>'required|string',
            'category_id'=>'required|exists:categories,id',
            'description'=>'required|string',
            'image.*'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price'=>'required_without:variations|numeric|min:0',
            'stock'=>'required_without:variations|integer|min:0',

            'variations.*.color'=> 'required_with:variations|string',
            'variations.*.size'=> 'required_with:variations|string',
            'variations.*.price' => 'required_with:variations|numeric|min:0',
            'variations.*.stock' => 'required_with:variations|integer|min:0',

        ]);
        DB::beginTransaction();

        try{
            // update produk
            $product -> update ([
                'category_id' => $request->category_id,
                'product_name' => $request->product_name,
                'description' => $request->description,
            ]);
            // update gambar produk
            if ($request -> hasFile('image')){
                foreach ($product->gambar_produk as $image) {
                    Storage::disk('productsImg')->delete('storage/productsImg/' . $image->image);
                }

                $image = $request -> file('image');

                foreach ($image as $index => $img){
                    $filename = time() . '_' .$index . '-' . Str::random(10) . '.' . $img->getClientOriginalExtension();
                    $img->storeAs('productsImg', $filename, 'public');
                    Gambar_produk::create([
                        'product_id' => $product->id,
                        'image' => $filename,
                        'is_primary' => $index === 0 ? 1 : 0,
                    ]);
                }
            }

            // update variasi produk
            if ($request->has('variations')&& is_array($request->variations)) {
                // Hapus variasi lama
                $product->productVariations()->delete();

                // Tambah variasi baru
                foreach ($request->variations as $variation) {
                    Product_variation::create([
                        'product_id' => $product->id,
                        'color' => $variation['color'],
                        'size'  => $variation['size'],
                        'sku'   => $variation['sku'],
                        'price' => $variation['price'],
                        'stock' => $variation['stock'],
                    ]);
                }
            } else {
            //    update produk tunggal
                $singleVariation = $product->productVariations()->first();
                if ($singleVariation) {
                    $singleVariation->update([
                        'price' => $request->price,
                        'stock' => $request->stock,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('project.view-data')->with('success','Product berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate produk: ' . $e->getMessage());
        }
    }
    
    public function delete(Product $product, $id)
    {
        DB::beginTransaction();
        try{
            // Hapus gambar dari storage
            foreach ($product->gambar_produk as $image) {
                Storage::disk('public')->delete('productsImg/' . $image->image);
            }
            // Hapus record relasi
            $product->gambarProduk()->delete();
            $product->productVariations()->delete();
            // Hapus produk
            $product->delete();

            DB::commit();
            
            return redirect()->route('project.view-data')->with('success', 'Produk berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    }
}