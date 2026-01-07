<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product_variation;
use App\Models\Gambar_produk;

class HomeController extends Controller
{
    public function index()
    {
        // Featured products untuk banner
        $produkBanner = Product::with(['gambar_produk', 'product_variation', 'category'])
            ->where('status', 'show')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // New Arrivals (8 produk terbaru)
        $newArrivals = Product::with(['gambar_produk', 'product_variation'])
            ->where('status', 'show')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Best Sellers (simulasi)
        $bestSellers = Product::with(['gambar_produk', 'product_variation'])
            ->where('status', 'show')
            ->inRandomOrder()
            ->take(8)
            ->get();

        // Related Products (random 6 produk)
        $relatedProducts = Product::with(['gambar_produk', 'product_variation'])
            ->where('status', 'show')
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('web.home-page', compact(
            'produkBanner',
            'newArrivals',
            'bestSellers',
            'relatedProducts'
        ));
    }
    
}