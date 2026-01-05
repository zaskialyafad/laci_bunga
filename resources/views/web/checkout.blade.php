@extends('layout.template-page')

@section('content')
<div class="container py-5">
    
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">Checkout</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Tampilkan Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ups! Ada masalah:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Kolom Kiri: Form Pengiriman --}}
        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('checkout.process') }}" method="post" id="checkoutForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Penerima</label>
                            <input type="text" name="receiver_name" class="form-control @error('receiver_name') is-invalid @enderror" 
                                   placeholder="Contoh: Budi Santoso" 
                                   value="{{ old('receiver_name') }}" required>
                            @error('receiver_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   placeholder="Contoh: 08123456789" 
                                   value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                      rows="4" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos" required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Input Hidden Total Price --}}
                        <input type="hidden" name="total_price" value="{{ $subTotal }}">

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg shadow fw-bold">
                                <i class="fas fa-lock me-2"></i> Buat Pesanan & Bayar
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Keranjang
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Ringkasan Pesanan --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 1;">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0 fw-bold">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        {{-- Loop Barang --}}
                        @foreach ($cart as $c)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div class="d-flex align-items-center">
                                    {{-- Gambar Kecil (Jika ada) --}}
                                    <div class="me-3" style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 8px; overflow: hidden;">
                                        @if($c->product->gambar_produk->count() > 0)
                                            <img src="{{ asset('storage/productsImg/' . $c->product->gambar_produk->first()->image) }}" 
                                                 class="w-100 h-100" style="object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/no-image.png') }}" class="w-100 h-100" style="object-fit: cover;">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-dark">{{ $c->product->product_name }}</h6>
                                        <small class="text-muted">
                                            Var: {{ $c->product_variation->color }} | Size: {{ $c->product_variation->size }} <br>
                                            {{ $c->quantity }} x Rp {{ number_format($c->product_variation->price, 0, ',', '.') }}
                                        </small>
                                    </div>
                                </div>
                                <span class="fw-semibold">
                                    Rp {{ number_format($c->product_variation->price * $c->quantity, 0, ',', '.') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Total --}}
                <div class="card-footer bg-white p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal Produk</span>
                        <span>Rp {{ number_format($subTotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Ongkos Kirim</span>
                        <span class="text-success fw-bold">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Total Pembayaran</h5>
                        <h4 class="mb-0 fw-bold text-primary">Rp {{ number_format($subTotal, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection