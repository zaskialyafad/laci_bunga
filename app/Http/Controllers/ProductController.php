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
use App\Models\Order;

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
        return view ('project.view-data', compact('products'));

    }

    public function tambah()
    {

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
            return redirect()->route('admin.view-data')->with('success','Product berhasil ditambahkan!');
        } catch (\Exception $e) {

         // rollback jika terjadi error
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Gagal simpan: ' . $e->getMessage());        }      
    }
    
    
    public function edit(Product $product)
    {
        // menampilkan detail produk yang akan di edit
        $product->load(['category','gambar_produk', 'product_variation']);
        $category = Category::all();
        return view ('project.edit', compact('product','category'));
    }

    public function editProduct(Request $request, Product $product)
{
    $request->validate([
        'product_name' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'status' => 'required|in:show,archive',
        'image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    DB::beginTransaction();
    try {
        //Update data produk utama
        $product->update([
            'category_id'  => $request->category_id,
            'product_name' => $request->product_name,
            'description'  => $request->description,
            'status'       => $request->status,
        ]);

        // Update Gambar (Jika ada upload baru)
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari folder 'productsImg'
            foreach ($product->gambar_produk as $image) {
                Storage::disk('public')->delete('productsImg/' . $image->image);
            }
            $product->gambar_produk()->delete();

            foreach ($request->file('image') as $index => $img) {
                $filename = time() . '_' . $index . '-' . Str::random(10) . '.' . $img->getClientOriginalExtension();
                $img->storeAs('productsImg', $filename, 'public');
                Gambar_produk::create([
                    'product_id' => $product->id,
                    'image'      => $filename,
                    'is_primary' => $index === 0 ? 1 : 0,
                ]);
            }
        }

        // Update Variasi
        // Jika ada input variasi baru atau variasi yang diedit
        if ($request->has('variations')) {
            // Hapus variasi lama
            $product->product_variation()->delete(); 

            foreach ($request->variations as $variation) {
                Product_variation::create([
                    'product_id' => $product->id,
                    'color'      => $variation['color'],
                    'size'       => $variation['size'],
                    'sku'        => $variation['sku'] ?? 'SKU-' . strtoupper(Str::random(8)),
                    'price'      => $variation['price'],
                    'stock'      => $variation['stock'],
                ]);
            }
        } else {
            // Update harga/stok produk tunggal
            $single = $product->product_variation()->first();
            if ($single) {
                $single->update([
                    'price' => $request->price,
                    'stock' => $request->stock,
                ]);
            }
        }

        DB::commit();
        return redirect()->route('admin.view-data')->with('success', 'Produk berhasil diperbarui!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Gagal update: ' . $e->getMessage());
    }
}
    
    public function delete(Product $product)
    {
        DB::beginTransaction();
        try{
            // Hapus gambar dari storage
            foreach ($product->gambar_produk as $image) {
                Storage::disk('public')->delete('productsImg/' . $image->image);
            }
            // Hapus data di database
            $product->gambar_produk()->delete();
            $product->product_variation()->delete();
            $product->delete();

            DB::commit();
            
            return redirect()->route('admin.view-data')->with('success', 'Produk berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }    
    }

    public function allProduk (Request $request)
    {
        $query = Product::with(['category', 'gambar_produk', 'product_variation'])->where('status', 'show');
        $category = Category::all();        

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('product_name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('product_name', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        return view ( 'web.all-produk', compact('products', 'category'));
    }

    public function detail($id)
    {
        $product = Product::with(['gambar_produk', 'product_variation', 'category'])
            ->where('status', 'show')
            ->findOrFail($id);

        // Ambil produk terkait (produk dengan kategori yang sama)
        $relatedProducts = Product::with(['gambar_produk', 'product_variation'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $id)
            ->where('status', 'show')
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Kelompokkan variasi berdasarkan warna
        $colorGroups = $product->product_variation->groupBy('color');

        // Ambil semua ukuran yang tersedia
        $sizes = $product->product_variation->pluck('size')->unique()->values();

        return view('web.detail-produk', compact('product', 'relatedProducts', 'colorGroups', 'sizes'));
    }
    
    public function order(){

    $orders = Order::with(['user', 'items.product', 'items.product_variation'])
                ->latest()
                ->get();
                       
    return view('project.view-order', compact('orders'));
}

    public function deleteOrder($id)
{
    // Cari order
    $order = Order::findOrFail($id);
    
    $order->items()->delete();
    
    // Hapus order
    $order->delete();

    return redirect()->back()->with('success', 'Data order berhasil dihapus');
}
    
}