@extends('layout.template-admin')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-2 text-gray-800">
            Data Produk
        </h1>
        {{-- button tambah data --}}
        <a href="{{ route('project.tambah') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    <!-- Tabel Produk -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Status</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>SKU</th>
                            <th>Deskripsi</th> 
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            @php 
                                $variations = collect($product->product_variation ?? $product['product_variation'] ?? []);
                                $rowCount = $variations->count() > 0 ? $variations->count() : 1;
                                // mengelompokkan warna yang sama
                                $grupWarna = $variations-> groupBy('color');
                            @endphp
                            @php $barisPertama = true; @endphp
                            @foreach ($grupWarna as $warna => $variasiWarna)
                                @foreach($variasiWarna as $vIndex => $v)
                                    <tr>
                                        {{-- Kolom Utama (Hanya muncul di baris pertama produk) --}}
                                        @if($barisPertama)
                                            <td rowspan="{{ $rowCount }}" class="text-center">{{ $index + 1 }}</td>
                                            <td rowspan="{{ $rowCount }}" class="text-center">
                                                @if($product->gambar_produk->count() > 0)
                                                <img src="{{ asset('storage/productsImg/'.$product->gambar_produk->first()->image) }}" width="70" class="rounded border">
                                                @else
                                                    <img src="{{ asset('assets/img/no-image.png') }}" width="70" class="rounded border">
                                                @endif
                                            </td>
                                            {{-- kolom kategori --}}
                                            <td rowspan="{{ $rowCount }}" class="text-center">
                                                <span class="badge bg-info text-white">{{ $product->category->name }}</span>
                                            </td>
                                            {{-- kolom nama produk --}}
                                            <td rowspan="{{ $rowCount }}"><strong>{{ $product->product_name }}</strong></td>
                                        
                                            {{-- Kolom Status --}}
                                            <td rowspan={{ $rowCount }} class="text-center">
                                                @if($product->status === 'show')
                                                    <span class="badge bg-success">Tampil</span>
                                                @else
                                                    <span class="badge bg-secondary">Arsip</span>
                                                @endif
                                            </td>
                                        @endif
                                        {{-- Kolom Warna (Merge per grup warna) --}}
                                        @if($vIndex === 0)
                                            <td rowspan="{{ $variasiWarna->count() }}" class="text-center">
                                                {{ $v->color ?? '-' }}
                                            </td>
                                        @endif
                                        {{-- Kolom Variasi (Muncul di setiap baris) --}}
                                        <td class="text-center">{{ $v->size ?? '-' }}</td>
                                        <td class="text-center font-weight-bold">{{ $v->stock }}</td>
                                        <td class="text-end text-primary fw-bold">
                                            Rp {{ number_format($v->price, 0, ',', '.') }}
                                        </td>
                                        <td><code>{{ $v->sku }}</code></td>
                                        {{-- Kolom Deskripsi & Aksi  --}}
                                        @if($barisPertama)
                                            <td rowspan="{{ $rowCount }}">
                                                {{-- Dilimit menjadi 40 karakter agar tidak terlalu panjang --}}
                                                <small class="text-muted">
                                                    {{ Str::limit($product->description, 40, '...') }}
                                                </small>
                                            </td>
                                            <td rowspan="{{ $rowCount }}" class="text-center">
                                                <div class="btn-group-vertical btn-group-sm">
                                                    <a href="{{ route('project.edit', $product->id) }}" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" onclick="hapusProduk('{{ $product->id }}', '{{ $product->product_name }}')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                    <form id="form-hapus-{{ $product->id }}" action="{{ route('project.delete', $product->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                             @php $barisPertama = false; @endphp
                                        @endif
                                    </tr>
                                @endforeach
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">Data produk masih kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

@endsection

<script>
function hapusProduk(id, nama) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Produk " + nama + " akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Menjalankan form hidden yang kita buat tadi
            document.getElementById('form-hapus-' + id).submit();
        }
    })
}

// Menampilkan Alert Sukses dari Controller
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
    });
@endif
</script>