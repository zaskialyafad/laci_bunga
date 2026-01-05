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
                        <th style="width: 5%">No</th>
                        <th>No Order</th>
                        <th>Tanggal</th>
                        <th>Item Order</th>
                        <th>Nama Penerima</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <ul class="list-unstyled m-0">
                                @foreach($order->items as $item)
                                    <li class="mb-1"> 
                                        - {{ $item->product->product_name }} 
                                        <small class="text-muted">
                                            ({{ optional($item->product_variation)->color ?? '-' }}, {{ optional($item->product_variation)->size ?? '-' }})
                                        </small>
                                        x <span class="fw-bold">{{ $item->quantity }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $order->receiver_name }}</td>
                        <td>Rp {{ number_format($order->total_price) }}</td>
                        <td>
                            <span class="badge badge-">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.delete-order', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data order ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Order">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            

        </div>
    </div>
</div>
@endsection