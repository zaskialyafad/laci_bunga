@extends('layout.template-page')
@section('content')

{{-- Breadcrumb --}}
<section class="py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('web.home-page') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('web.all-produk') }}">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->product_name }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Product Detail --}}
<section class="py-5">
    <div class="container">
        <div class="row">
            {{-- Product Images --}}
            <div class="col-md-6">
                <div class="product-images">
                    {{-- Main Image --}}
                    <div class="main-image mb-3">
                        @if($product->gambar_produk->count() > 0)
                            <img id="mainImage" 
                                 src="{{ asset('storage/productsImg/' . $product->gambar_produk->first()->image) }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="img-fluid rounded border">
                        @else
                            <img id="mainImage" 
                                 src="{{ asset('assets/img/no-image.png') }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="img-fluid rounded border">
                        @endif
                    </div>
                    
                    {{-- Thumbnail Images --}}
                    @if($product->gambar_produk->count() > 1)
                    <div class="thumbnails d-flex gap-2">
                        @foreach($product->gambar_produk as $image)
                            <img src="{{ asset('storage/productsImg/' . $image->image) }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="img-thumbnail thumbnail-img" 
                                 style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                 onclick="changeMainImage('{{ asset('storage/productsImg/' . $image->image) }}')">
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-md-6">
                <div class="product-info">
                    <span class="badge bg-info text-white mb-2">{{ $product->category->name }}</span>
                    <h1 class="h2 mb-3">{{ $product->product_name }}</h1>
                    
                    {{-- Price Range --}}
                    @if($product->product_variation->count() > 0)
                        @php
                            $minPrice = $product->product_variation->min('price');
                            $maxPrice = $product->product_variation->max('price');
                        @endphp
                        <div class="price mb-4">
                            <h3 class="text-primary">
                                @if($minPrice == $maxPrice)
                                    Rp {{ number_format($minPrice, 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($minPrice, 0, ',', '.') }} - Rp {{ number_format($maxPrice, 0, ',', '.') }}
                                @endif
                            </h3>
                        </div>
                    @endif

                    {{-- Description --}}
                    <div class="description mb-4">
                        <h5>Description</h5>
                        <p>{{ $product->description }}</p>
                    </div>

                    {{-- Variation Selection --}}
                   {{-- Form Add to Cart Tradisional --}}
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        {{-- Pemilihan Variasi Langsung --}}
                        <div class="mb-4">
                            <h6 class="fw-bold">Select Color & Size:</h6>
                            <select name="product_variation_id" class="form-select" required>
                                <option value="">-- Choose Option --</option>
                                @foreach($product->product_variation as $v)
                                    <option value="{{ $v->id }}">
                                        {{ $v->color }} | Size: {{ $v->size }} 
                                        (Rp {{ number_format($v->price, 0, ',', '.') }}) 
                                        - Stock: {{ $v->stock }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Prices and stock are shown per selection.</small>
                        </div>

                        {{-- Quantity --}}
                        <div class="mb-4">
                            <h6>Quantity:</h6>
                            <input type="number" class="form-control text-center" name="quantity" 
                                value="1" min="1" style="max-width: 100px;">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </form>

                    {{-- Tombol Wishlist --}}
                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-outline-secondary btn-lg w-100">
                            @if($product->is_wishlisted)
                                <i class="fas fa-heart text-danger"></i> Remove from Wishlist
                            @else
                                <i class="far fa-heart"></i> Add to Wishlist
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Products --}}
@if($relatedProducts->count() > 0)
<section class="related-products py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Related Products</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('web.detail-produk', $related->id) }}">
                            @if($related->gambar_produk->count() > 0)
                                <img src="{{ asset('storage/productsImg/' . $related->gambar_produk->first()->image) }}" 
                                     class="card-img-top" 
                                     style="height: 250px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/img/no-image.png') }}" 
                                     class="card-img-top" 
                                     style="height: 250px; object-fit: cover;">
                            @endif
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">
                                <a href="{{ route('web.detail-produk', $related->id) }}" class="text-decoration-none text-dark">
                                    {{ $related->product_name }}
                                </a>
                            </h6>
                            @if($related->product_variation->count() > 0)
                                @php
                                    $minPrice = $related->product_variation->min('price');
                                    $maxPrice = $related->product_variation->max('price');
                                @endphp
                                <p class="text-primary fw-bold mb-0">
                                    @if($minPrice == $maxPrice)
                                        Rp {{ number_format($minPrice, 0, ',', '.') }}
                                    @else
                                        Rp {{ number_format($minPrice, 0, ',', '.') }}+
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif



@endsection