<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


//import model 
use App\Models\Product; 
use App\Models\Category;
use App\Models\Product_variation;
use App\Models\Gambar_produk;

//import return type View
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //ambil semua products
        $products = Product::with(['category', 'product_variation', 'Gambar_produk'])->get();
        return view('project.view-data', compact('products'));
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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',  // Field 'gambar' untuk single image
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'size' => 'required',
            'color' => 'required|string',
        ]);

         // buat produk
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        //simpan variasi produk
        Product_variation::create([
            'product_id' => $product->id,
            'stock' => $request->stock,
            'size' => $request->size,
            'color' => $request->color,
        ]);
       
        //upload gambar & simpan gambar
        $product = Product::findOrFail($product->id);
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/project'), $filename);
            $product->Gambar_produk->image = $filename;
            
            $product->gambarProduk()->create([
                'image' => $filename,
                'is_primary' => 1,  // Set sebagai primary jika single
             ]);
        }

        $product->save();
        return redirect()->route('project.view-data')->with('success','Product berhasil ditambahkan!');    
    }
    
    
    public function edit(Product $product)
    {
        // menampilkan detail produk yang akan di edit
        $product = Product::findOrFail($product->id);
        $category = Category::all();
        return view('project.edit',compact('product', 'category'));
    }

    Public function editProduct(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',  // Nullable untuk edit
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);
        
        
        $product= Product::findOrFail($id);
        if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                foreach ($product->gambarProduk as $oldImage) {
                    Storage::disk('public')->delete('project/' . $oldImage->image);
                    $oldImage->delete();
                }
                // Upload baru
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('project', $filename, 'public');
                $product->gambarProduk()->create([
                    'image' => $filename,
                    'is_primary' => 1,
                ]);
            }

        // Update data produk
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'price' => $request->price,
            ]);
        $product->save();
        return redirect()->route('project.view-data')->with('success','Product berhasil diupdate!');
    
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
            // Hapus gambar dari storage
            foreach ($product->gambarProduk as $image) {
                Storage::disk('public')->delete('project/' . $image->image);
            }
            // Hapus record relasi
            $product->gambarProduk()->delete();
            $product->productVariations()->delete();  // Hapus variasi juga
            // Hapus produk
            $product->delete();
            return redirect()->route('project.view-data')->with('success', 'Product berhasil dihapus!');
    }
}