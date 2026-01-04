@extends('layout.template-page')
@section('content')
<section id="payment">
    <div class="container py-5 text-center">
        <h2>Satu langkah lagi!</h2>
        <p>Pesanan <strong>{{ $order->order_number }}</strong> telah dibuat.</p>
        <button id="pay-button" class="btn btn-primary btn-lg">Bayar sekarang</button>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = '{{ route("web.home-page") }}'; 
            },
            onPending: function(result){
                window.location.href = '{{ route("web.home-page") }}';
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            }
        });
    };
</script>
@endsection