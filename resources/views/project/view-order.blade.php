@extends('layout.template-admin') 

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pesanan Masuk</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No Order</th>
                        <th>Tanggal</th>
                        <th>Nama Penerima</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->receiver_name }}</td>
                        <td>Rp {{ number_format($order->total_price) }}</td>
                        <td>
                            <span class="badge badge-{{ $order->status == 'paid' ? 'success' : 'warning' }}">
                                {{ $order->status ?? 'Pending' }}
                            </span>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            

        </div>
    </div>
</div>
@endsection