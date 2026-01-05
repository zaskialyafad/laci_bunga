@extends('layout.template-page')
@section('content')
<section id="payment">
    <div class="container py-5 text-center">
        
        {{-- Alert KUNING Jika Pending --}}
        @if(request('status') == 'pending')
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                <strong><i class="fas fa-clock"></i> Menunggu Pembayaran!</strong><br>
                Silakan selesaikan pembayaran Anda pada popup yang muncul.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2>Selesaikan Pembayaran</h2>
        <p>Invoice: <strong>{{ $order->order_number }}</strong></p>

        {{-- Detail Barang (Diambil dari tabel OrderItem) --}}
        <div class="card mb-4 mx-auto text-start shadow-sm" style="max-width: 600px;">
            <div class="card-body">
                <h5 class="card-title border-bottom pb-2">Rincian Pesanan</h5>
                <ul class="list-group list-group-flush">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <div>
                                <strong>{{ $item->product->product_name }}</strong> <br>
                                <small class="text-muted">
                                    {{ $item->product_variation->color }} / {{ $item->product_variation->size }} (x{{ $item->quantity }})
                                </small>
                            </div>
                            <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between fw-bold fs-5 px-0 pt-3">
                        <span>Total Bayar</span>
                        <span class="text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <button id="pay-button" class="btn btn-primary btn-lg w-50 shadow">Bayar Sekarang</button>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $order->snap_token }}', {
            // JIKA SUKSES: Redirect ke route success (Status DB berubah jadi Paid)
            onSuccess: function(result){
                window.location.href = '{{ route("checkout.success", $order->id) }}' 
            },
            // JIKA PENDING/CLOSE: Reload halaman ini + kasih parameter status=pending
            onPending: function(result){
                window.location.href = '{{ route("checkout.payment", $order->id) }}?status=pending';
            },
            onClose: function(){
                window.location.href = '{{ route("checkout.payment", $order->id) }}?status=pending';
            },
            // JIKA ERROR
            onError: function(result){
                alert("Pembayaran gagal!");
            }
        });
    };
</script>
@endsection