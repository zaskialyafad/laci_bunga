@extends('layout.template-page')
@section('content')
<section id="payment">
    <div class="container py-5 text-center">
        <h2>Satu langkah lagi!</h2>
        <p>Pesanan <strong>{{ $order->order_number}}</strong>t telah dibuat.</p>
        <button id="pay-button" class="btn btn-primary btn-lg">Bayar sekarang</button>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript"></script>>
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}',{
            onSuccess: function(result){windiw.lcation.href = '/success';}
            onPending: function(result){windiw.lcation.href = '/pending';}
            onError: function(result){windiw.lcation.href = '/error';}
            
        });
    };
</script>

@endsection