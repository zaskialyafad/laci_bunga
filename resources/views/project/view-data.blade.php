@extends('layout.template-admin')
@section('content')
    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>
                    {{-- button tambah data --}}
                    <a href="{{ route('project.tambah') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Produk</th>
                                            <th>Kategori</th>
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Warna</th>
                                            <th>Ukuran</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->id }}</td>
                                            <td>{{ $p->category->name }}</td>
                                             <td>
                                                <img src="{{ asset('uploads/project/'.$p->image) }}" width="80" alt="{{ $p->name }}">
                                            </td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->product_variation->first()->color ?? '-' }}</td>
                                            <td>{{ $p->product_variation->first()->size ?? '-' }}</td>
                                            <td>{{ "Rp " . number_format($p->product_variation->first()->price ?? 0, 0, ',', '.') }}</td>
                                            <td>{{ $p->product_variation->first()->stock ?? '-' }}</td>
                                            <td>{{ $p->description }}</td>
                                            <td style="width: 20%">
                                                <a href="{{ route('project.edit', $p->id) }}" class="btn btn-warning mb-3">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->

                </div>
            <!-- End of Main Content -->

@endsection