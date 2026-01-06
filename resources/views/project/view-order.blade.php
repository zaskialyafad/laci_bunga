@extends('layout.template-admin') 

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pesanan Masuk</h1>
</div>

{{-- Alert Sukses --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>No Order</th>
                        <th>Tanggal</th>
                        <th>Item Order</th>
                        <th>Nama Penerima</th>
                        <th>Total Harga</th>
                        <th>Alamat Pengiriman</th> {{-- GANTI HEADER STATUS JADI ALAMAT --}}
                        <th style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        
                        {{-- KOLOM ITEM ORDER --}}
                        <td>
                            <ul class="list-unstyled m-0">
                                @if($order->items->isEmpty())
                                    <li class="text-danger small">
                                        <em>Item kosong (Order Lama)</em>
                                    </li>
                                @else
                                    @foreach($order->items as $item)
                                        <li class="mb-2 border-bottom pb-1"> 
                                            <strong>{{ optional($item->product)->product_name ?? 'Produk Dihapus' }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ optional($item->product_variation)->color ?? '-' }} / 
                                                {{ optional($item->product_variation)->size ?? '-' }}
                                            </small> 
                                            x <b>{{ $item->quantity }}</b>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>

                        <td>{{ $order->receiver_name }}</td>
                        <td>Rp {{ number_format($order->total_price) }}</td>
                        
                        {{-- KOLOM ALAMAT (PENGGANTI STATUS) --}}
                        <td>
                            {{ $order->address }}
                        </td>

                        {{-- KOLOM AKSI --}}
                        <td class="text-center">
                            <form action="{{ route('admin.delete-order', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data order ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Order">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center p-4">Belum ada data pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection