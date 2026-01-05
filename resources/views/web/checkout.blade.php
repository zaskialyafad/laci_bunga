@extends('layout.template-page')
@section('content')
<div class="container py-5">
    <h2>Checkout</h2>
    <div class="row">
        {{-- form pengiraman --}}
        <div class="col-md-7">
            <h4 class="mb-3">Alamat Pengiriman</h4>
            <form action="{{ route('checkout.process') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label>Nama Penerima</label>
                    <input type="text" name="receiver_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nomor Telepom</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" rows="3"></textarea>
                </div>
                <input type="hidden" name="total_price" value="{{ $subtotal }}">
                <button type="submit" class="btn btn-success w-100 btn-lg mt-3">
                    Place Order & Payment
                </button>
            </form>
        </div>
        {{-- ringkasan pesanan --}}
        <div class="col-md-5">
            <div class="card bg-light">
                <div class="card-body">
                    <h4 class="card-title">Order</h4>
                    <hr>
                    @foreach ($cart as $c )
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $cart->product->product_name }} (x{{ $cart->quantity }})</span>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span>Rp {{ number_format($subtotal) }}</span>                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection