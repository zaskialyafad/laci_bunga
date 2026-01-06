@extends('layout.template-page')
@section('content')
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

    {{-- Header --}}
    <section id="header" class="py-5 bg-light">
        <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('web.home-page') }}">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </nav>
        <h3 class="text-center">All Products</h3>
        </div>
    </section>

    {{-- Filter dan produk --}}
    <section id="filterProduk" class="py-5">
        <div class="container">
            <div class="row mb-4">
                {{-- filter dan search --}}
                <div class="col-md-12">
                    <form action="{{ route('web.all-produk') }}" method="GET" class="row g-3">
                        {{-- search --}}
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                        </div>

                        {{-- Filter kategori --}}
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($category as $cat )
                                    <option value="{{ $cat->id }} {{ request('category') == $cat->id ? 'selected' : '' }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Sort --}}
                        <div class="col-md-3">
                            <select name="sort" class="form-select">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            </select>
                        </div>
                        {{-- Submit --}}
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- produk --}}
            <div class="row">
                @forelse ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="poduct-item image-zoom-effect link-effect h-100">
                        <div class="card h-100">
                            <div class="image-holder position-relative">
                                <a href="{{ route('web.detail-produk', $product->id) }}">
                                    @if ($product->gambar_produk->count()>0)
                                        <img src="{{asset('storage/productsImg/' . $product->gambar_produk->first()->image)}}" alt="{{ $product->product_name }}" class="card-img-top product-image" style="width: 100%; height: 300px; object-fit: cover; object-position: center;">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}" alt="{{ $product->product_name }}" class="card-img-top product-image" style="width: 100%; height: 300px; object-fit: cover; object-position: center;">                                        
                                    @endif
                                </a>
                                <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        
                                        {{-- Cek apakah produk ini sudah ada di wishlist user --}}
                                        @php
                                            $inWishlist = false;
                                            if(auth()->check()) {
                                                $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                                                            ->where('product_id', $product->id)
                                                            ->exists();
                                            }
                                        @endphp

                                        <button type="submit" class="btn btn-light btn-sm shadow-sm rounded-circle" style="width: 40px; height: 40px;">
                                            @if($inWishlist)
                                                <i class="fas fa-heart text-danger"></i> {{-- Hati Merah (Solid) --}}
                                            @else
                                                <i class="far fa-heart"></i> {{-- Hati Kosong (Regular) --}}
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <span class="badge bg-info text-white mb-2">{{ $product->category->name }}</span>
                                <h5 class="card-title">
                                    <a href="{{ route('web.detail-produk', $product->id) }}" class="text-decoration-none text-dark">
                                        {{ $product->product_name }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">
                                    {{ Str::limit($product->description, 60) }}
                                </p>
                                @if($product->product_variation->count() > 0)
                                    @php
                                        $hargaMin = $product->product_variation->min('price');
                                        $hargaMax = $product->product_variation->max('price');
                                    @endphp
                                    <div class="text-primary fw-bold">
                                        @if($hargaMin == $hargaMax)
                                            Rp {{ number_format($hargaMin, 0, ',', '.') }}
                                        @else
                                            Rp {{ number_format($hargaMin, 0, ',', '.') }} - Rp {{ number_format($hargaMax, 0, ',', '.') }}
                                        @endif
                                    </div>
                                @endif
                                <a href="{{ route('web.detail-produk', $product->id) }}" class="btn btn-outline-primary btn-sm mt-2 w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                    
                @empty
                    <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>No products found</h4>
                        <p>Try adjusting your filters or search terms.</p>
                    </div>
                </div>
                @endforelse

            </div>
            {{-- Pagination --}}
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection