<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


//import model 
use App\Models\Product; 
use App\Models\Category;
use App\Models\Product_variation;
use App\Models\gambar_produk;

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
        $products = Product::with(['category', 'product_variation', 'gambar_produk'])->get();
        return view('project.view-data', compact('products'));
    }

    public function tambah()
    {
        // untuk panggil category agar bisa ditapilkan di dropdown
        $category = Category::all();
        return view('project.tambah', compact('category'));
    }

    public function simpanProjek(Request $request)
    {
        $request->validate([
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'size' => 'required',
            'colors' => 'required|array',
            'colors.*' => 'required|string',
        ]);

         // simpan produk
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
       
        //upload gambar & simpan gambar
        if ($request->hasFile('image')) {
        foreach ($request->file('image') as $index => $image) {
            $filename = time() . '_' . $index . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $filename);
            
            gambar_produk::create([
                'product_id' => $product->id,
                'image' => $filename,
                'is_primary' => $index === 0 ? 1 : 0, // Set foto pertama jadi primary image
            ]);
        }
    }
        
        // simpan variasi produk
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'All Size'];
        $colors = $request->color;

        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                Product_variation::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'color' => $color,
                    'stock' => $request->stock,
                    // sku(Stock Keeping Unit) dibuat dari inisial nama produk, size, color, dan angka random contoh: TSH-M-MER-1234
                    'sku' => strtoupper(substr($product->name, 0, 3)) . '-' . strtoupper($size) . '-' . strtoupper($color) . '-' . rand(1000, 9999),
                ]);
            }
        }
    
    return redirect()->route('project.view-data')->with('success','Product berhasil ditambahkan!');    }

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
            'image.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'size' => 'required',
            'colors' => 'required|array',
            'colors.*' => 'required|string',
        ]);
        
        
        $product= Product::findOrFail($id);
        if ($request->hasFile('image')) {
            //hapus gambar lama
           if (file_exists(public_path('uploads/project/' . $product->image))) {
                unlink(public_path('uploads/project/' . $product->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/project'), $filename);
            $product->image = $filename;  
        }

        // Update data product
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();
        
        $product->product_variation->price = $request->price;
        $product->product_variation->stock = $request->stock;
        $product->product_variation->size = $request->size;
        $product->product_variation->color = $request->color;   
        $product->save();
        return redirect()->route('project.view-data')->with('success','Product berhasil diupdate!');
    
    }
    public function delete($id)
    {
        // menghapus produk
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('project.view-data')->with('success','Product berhasil dihapus!');  
    }
}