@extends('layout.template-admin')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit data</h6>
        </div>
        <div class="card-body">
            {{-- Form tambah data --}}
            <form action="/project/tambah" method="POST" enctype="multipart/form-data">
                  @csrf
                {{-- nama data --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Produk<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                {{-- kategori --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori<span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>          
                        @foreach($category as $c)
                                <option value="{{ $c->id}}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                    </select>
                </div>
                {{-- Harga --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Harga<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                {{-- Variasi --}}
                <div class="mb-3">
                    <label>Variasi (Warna & Stok)</label>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="color" class="form-control" placeholder="Warna (Misal: Merah)">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="stock" class="form-control" placeholder="Stok" inputmode="numeric">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="size" class="form-control" placeholder="Ukuran (S/M/L)">
                        </div>
                    </div>
                </div>
                {{-- gambar --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Produk <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" 
                           name="images[]" id="image" multiple accept="image/*" required>
                    <small class="text-muted">Bisa upload beberapa gambar sekaligus. Gambar pertama akan jadi gambar utama.</small>

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