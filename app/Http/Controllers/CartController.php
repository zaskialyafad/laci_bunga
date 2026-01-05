<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product_variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller 
{

    public function index()
    {
        $carts = Cart::with(['product.gambar_produk', 'product_variation', 'product'])
            ->where('user_id', Auth::id())
            ->get();
        
        $subtotal = $carts->sum(function($cart) {
            return $cart->product_variation->price * $cart->quantity;
        });
        
        return view('web.cart', compact('carts', 'subtotal'));
    }

    // Tambah ke cart (Dari halaman produk)
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variation_id' => 'required|exists:product_variations,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $variation = product_variation::findOrFail($request->product_variation_id);

        $cartItem = Cart::where('product_variation_id', $request->product_variation_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if ($variation->stock < $newQuantity) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi.');
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            if ($variation->stock < $request->quantity) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi.');
            }

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'product_variation_id' => $request->product_variation_id,
                'quantity' => $request->quantity
            ]);
        }

return redirect()->back()->with('success', 'Produk berhasil ditambah ke keranjang.');    }

    // Update quantity
    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($request->action == 'increase') {
            if($cart->quantity < $cart->product_variation->stock) {
                $cart->increment('quantity');
            } else {
                return redirect()->back()->with('error', 'Stok tidak mencukupi.');
            }
        } else {
            if($cart->quantity > 1) {
                $cart->decrement('quantity');
            }
        }

        return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Keranjang telah dikosongkan.');
    }
}