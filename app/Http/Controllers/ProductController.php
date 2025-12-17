<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


//import model 
use App\Models\Product; 
use App\Models\Category;
use App\Models\product_variation;

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
        $products = Product::all();
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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'size' => 'required',
            'color' => 'nullable',
        ]);
       
        //upload gambar
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/project'), $filename);
        
        // simpan produk
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
        ]);
        
        // simpan variasi produk
        $Product_variation = Product_variation::create([
            'product_id' => $product->id,
            'price' => $request->price,
            'stock' => $request->stock,
            'size' => $request->size,
            'color' => $request->color,
        ]);
    
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
        // update produk
       $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'size' => 'required',
            'color' => 'nullable',
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
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
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