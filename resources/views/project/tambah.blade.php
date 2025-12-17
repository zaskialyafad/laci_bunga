@extends('layout.template-admin')
@section('content')
<h3>Tambah Produk</h3>
<form action="/project/tambah" method="POST"
enctype="multipart/form-data">
@csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select name="category_id" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>          
               @foreach($category as $c)
                    <option value="{{ $c->id}}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}
                     </option>
                @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="color" class="form-label">Warna</label>
        <input type="text" class="form-control" id="color" name="color" required>
    </div>
    <div class="mb-3">
        <label for="size" class="form-label">Ukuran</label>
        <input type="text" class="form-control" id="size" name="size" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stok</label>
        <input type="number" class="form-control" id="stock" name="stock" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label fw-bold">Gambar</label>
        <input type="file" class="form-control" name="image" id="image" required>
    </div>
     <!-- Tombol Submit -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan Produk
        </button>
        <a href="{{ route('project.view-data') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</form

    @endsection