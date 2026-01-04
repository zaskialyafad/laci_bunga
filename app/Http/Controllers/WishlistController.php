<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishlistController extends Controller 
{
    public function index(): View
    {
        // Mengambil data wishlist milik user yang login beserta relasi produknya
        $wishlists = Wishlist::with(['product.gambar_produk', 'product.product_variation'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Mengirim data ke view
        return view('web.wishlist', compact('wishlists'));
    }

    /**
     * Menambah atau Menghapus dari wishlist (Toggle).
     * Digunakan pada tombol hati di halaman Home/All Products.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete(); // Jika sudah ada, dihapus
            $message = 'Produk dihapus dari wishlist.';
        } else {
            Wishlist::create([ // Jika belum ada, ditambah
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ]);
            $message = 'Produk ditambahkan ke wishlist.';
        }

        return redirect()->back()->with('success', $message);
    }

     
    public function remove($id)
    {
        // Cari data berdasarkan ID dan pastikan milik user yang login
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlist->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari favorit.');
    }
}