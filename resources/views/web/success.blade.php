@extends('layout.template-page')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                
                {{-- Ikon Sukses Animasi --}}
                <div class="mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                </div>

                <h2 class="fw-bold mb-3">Pembayaran Berhasil!</h2>
                <p class="text-muted mb-4">
                    Terima kasih telah berbelanja. Pesanan Anda telah kami terima dan akan segera diproses.
                </p>

                {{-- Detail Singkat Order --}}
                <div class="bg-light rounded-3 p-3 mb-4 text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">No. Invoice</span>
                        <span class="fw-bold text-dark">{{ $order->order_number }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tanggal</span>
                        <span class="fw-bold text-dark">{{ $order->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Total Bayar</span>
                        <span class="fw-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-grid gap-2">
                    <a href="{{ route('web.all-produk') }}" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-shopping-bag me-2"></i> Belanja Lagi
                    </a>
                     
                </div>

            </div>
        </div>
    </div>
</div>
@endsection