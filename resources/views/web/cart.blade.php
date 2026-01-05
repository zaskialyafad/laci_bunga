@extends('layout.template-page')
@section('content')

{{-- Page Header --}}
<section class="py-4 bg-light">
    <div class="container">
        <h1 class="text-center mb-3">Shopping Cart</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('web.home-page') }}">Home</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Cart Content --}}
<section class="py-5">
    <div class="container">
        {{-- Tampilan Alert Pesan Sukses/Error --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($carts->count() > 0)
            <div class="row">
                {{-- Cart Items --}}
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Cart Items ({{ $carts->count() }})</h5>
                        </div>
                        <div class="card-body p-0">
                            @foreach($carts as $cart)
                                <div class="cart-item border-bottom p-3">
                                    <div class="row align-items-center">
                                        {{-- Product Image --}}
                                        <div class="col-md-2 col-3">
                                            @if($cart->product->gambar_produk->count() > 0)
                                                <img src="{{ asset('storage/productsImg/' . $cart->product->gambar_produk->first()->image) }}" 
                                                     class="img-fluid rounded" 
                                                     alt="{{ $cart->product->product_name }}">
                                            @else
                                                <img src="{{ asset('assets/img/no-image.png') }}" 
                                                     class="img-fluid rounded" 
                                                     alt="{{ $cart->product->product_name }}">
                                            @endif
                                        </div>

                                        {{-- Product Info --}}
                                        <div class="col-md-4 col-9">
                                            <h6 class="mb-1">
                                                <a href="{{ route('web.detail-produk', $cart->product_id) }}" class="text-dark text-decoration-none">
                                                    {{ $cart->product->product_name }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                Color: {{ $cart->productVariation->color }} | 
                                                Size: {{ $cart->productVariation->size }}
                                            </small><br>
                                            <small class="text-muted">SKU: {{ $cart->productVariation->sku }}</small>
                                        </div>

                                        {{-- Price --}}
                                        <div class="col-md-2 col-6 mt-2 mt-md-0">
                                            <strong class="text-primary">
                                                Rp {{ number_format($cart->productVariation->price, 0, ',', '.') }}
                                            </strong>
                                        </div>

                                        {{-- Quantity (Tradisional Form) --}}
                                        <div class="col-md-2 col-6 mt-2 mt-md-0">
                                            <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group input-group-sm">
                                                    {{-- Tombol Kurang --}}
                                                    <button class="btn btn-outline-secondary" type="submit" name="action" value="decrease" {{ $cart->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                                    
                                                    <input type="number" class="form-control text-center" value="{{ $cart->quantity }}" readonly>
                                                    
                                                    {{-- Tombol Tambah --}}
                                                    <button class="btn btn-outline-secondary" type="submit" name="action" value="increase" {{ $cart->quantity >= $cart->productVariation->stock ? 'disabled' : '' }}>+</button>
                                                </div>
                                            </form>
                                            <small class="text-muted">Stock: {{ $cart->productVariation->stock }}</small>
                                        </div>

                                        {{-- Subtotal & Remove --}}
                                        <div class="col-md-2 col-12 mt-2 mt-md-0 text-md-end">
                                            <div class="item-total mb-2">
                                                <strong>Rp {{ number_format($cart->productVariation->price * $cart->quantity, 0, ',', '.') }}</strong>
                                            </div>
                                            
                                            <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this item?')">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Continue Shopping --}}
                    <a href="{{ route('web.all-produk') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>

                {{-- Order Summary --}}
                <div class="col-lg-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span class="text-muted">Calculated at checkout</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong class="text-primary">Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                            </div>
                            
                            <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mb-2">
                                Proceed to Checkout
                            </a>

                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to clear your cart?')">
                                    Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty Cart --}}
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                <h3>Your cart is empty</h3>
                <p class="text-muted mb-4">Start shopping to add items to your cart</p>
                <a href="{{ route('web.all-produk') }}" class="btn btn-primary">
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</section>

@endsection