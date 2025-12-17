<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use App\Models\Product_variation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productsVariations = Product_variation::all();
        return view('project.view-data', compact('product_variation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('project.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(product_variation $product_variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product_variation $product_variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product_variation $product_variation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product_variation $product_variation)
    {
        //
    }
}
