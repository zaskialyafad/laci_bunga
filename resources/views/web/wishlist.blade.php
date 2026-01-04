@extends('layout.template-page')
@section('content')

{{-- Page Header --}}
<section class="py-4 bg-light">
    <div class="container">
        <h1 class="text-center mb-3">My Wishlist</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('web.home-page') }}">Home</a></li>
                <li class="breadcrumb-item active">Wishlist</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Wishlist Content --}}
<section class="py-5">
    <div class="container">
        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($wishlists->count() > 0)
            <div class="row g-4">
                @foreach($wishlists as $wishlist)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm position-relative">
                            
                            {{-- Form Hapus--}}
                            <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST" class="position-absolute top-0 end-0 m-2 z-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-circle" 
                                        style="width: 35px; height: 35px; padding: 0;"
                                        onclick="return confirm('Remove this item from wishlist?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>

                            {{-- Product Image --}}
                            <div class="position-relative overflow-hidden" style="height: 250px;">
                                <a href="{{ route('web.detail-produk', $wishlist->product->id) }}">
                                    @if($wishlist->product->gambar_produk->count() > 0)
                                        <img src="{{ asset('storage/productsImg/' . $wishlist->product->gambar_produk->first()->image) }}"
                                              alt="{{ $wishlist->product->product_name }}"
                                              class="card-img-top w-100 h-100"
                                             style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/no-image.png') }}"
                                              alt="{{ $wishlist->product->product_name }}"
                                              class="card-img-top w-100 h-100"
                                             style="object-fit: cover;">
                                    @endif
                                </a>
                                
                                {{-- Category Badge --}}
                                <span class="badge bg-info position-absolute bottom-0 start-0 m-2">
                                    {{ $wishlist->product->category->name }}
                                </span>
                            </div>

                            {{-- Product Info --}}
                            <div class="card-body p-3">
                                <h6 class="card-title mb-2" style="height: 40px; overflow: hidden;">
                                    <a href="{{ route('web.detail-produk', $wishlist->product->id) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $wishlist->product->product_name }}
                                    </a>
                                </h6>
                                
                                <p class="card-text text-muted small mb-2" style="height: 38px; overflow: hidden;">
                                    {{ Str::limit($wishlist->product->description, 50) }}
                                </p>
                                
                                {{-- Price --}}
                                @if($wishlist->product->product_variation->count() > 0)
                                    @php
                                        $minPrice = $wishlist->product->product_variation->min('price');
                                        $maxPrice = $wishlist->product->product_variation->max('price');
                                    @endphp
                                    <div class="text-primary fw-bold mb-2">
                                        @if($minPrice == $maxPrice)
                                            Rp {{ number_format($minPrice, 0, ',', '.') }}
                                        @else
                                            Rp {{ number_format($minPrice, 0, ',', '.') }}+
                                        @endif
                                    </div>
                                @endif
                                
                                {{-- Add to Cart Button --}}
                                <a href="{{ route('web.detail-produk', $wishlist->product->id) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-shopping-cart"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty Wishlist --}}
            <div class="text-center py-5">
                <i class="fas fa-heart fa-5x text-muted mb-4"></i>
                <h3>Your wishlist is empty</h3>
                <p class="text-muted mb-4">Save your favorite items here</p>
                <a href="{{ route('web.all-produk') }}" class="btn btn-primary">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</section>

@endsection