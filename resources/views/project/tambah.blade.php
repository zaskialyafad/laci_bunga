@extends('layout.template-admin')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Produk</h6>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.simpanProduk') }}" method="POST" enctype="multipart/form-data" id="formTambahProduk">
                @csrf
                <input type="hidden" id="productId" value="">
                
                {{-- BAGIAN 1: Informasi Dasar --}}
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Informasi Product</h5>
                    
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="namaProduk" name="product_name" value="{{ old('product_name') }}" required>
                        <div class="form-text text-end"><span id="sisaKarakterNama">0</span>/225</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select name="category_id" id="kategori" class="form-select" required>
                            <option value="">--Pilih Kategori--</option>
                            @foreach ($category as $c)
                                <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="deskripsi" name="description" required>{{ old('description') }}</textarea>
                        <div class="form-text text-end"><span id="sisaKarakter">0</span>/3000</div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Produk<span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="show" {{ old('status', $product->status) == 'show' ? 'selected' : '' }}>Tampilkan</option>
                            <option value="archive" {{ old('status', $product->status) == 'archive' ? 'selected' : '' }}>Arsipkan</option>
                        </select>
                    </div>
                </div>

                {{-- BAGIAN 2: Gambar Produk --}}
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Gambar Produk</h5>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Gambar Produk<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple required>
                        <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG.</small>
                    </div>
                </div>

                {{-- BAGIAN 3: Variasi & Harga --}}
                <div class="mb-4">
                    <h5 class="mb-3">Harga & Stok</h5>

                    {{-- A. MODE SINGLE PRODUCT (Default) --}}
                    <div id="single-section" class="card card-body bg-light mb-3">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="singlePrice">Harga Satuan (Rp)*</label>
                                <input type="number" name="price" id="singlePrice" class="form-control single-input" value="{{ old('price') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="singleStock">Stok Total*</label>
                                <input type="number" name="stock" id="singleStock" class="form-control single-input" value="{{ old('stock') }}" required>
                            </div>
                        </div>
                        <div class="mt-2 text-center">
                            <span class="text-muted small">Produk ini memiliki variasi warna/ukuran?</span><br>
                            <button type="button" class="btn btn-sm btn-primary mt-1" onclick="aktifkanModeVariasi()">
                                <i class="fas fa-list"></i> Aktifkan Variasi Produk
                            </button>
                        </div>
                    </div>

                    {{-- B. MODE VARIASI --}}
                    <div id="variation-section" style="display: none;">

                        <div class="card bg-light mb-3 border-primary">
                            <div class="card-body py-3">
                                <h6 class="text-primary font-weight-bold"><i class="fas fa-plus-circle"></i> Tambah Variasi</h6>
                                <p class="small text-muted mb-2">Pisahkan dengan koma. Contoh: <b>Merah, Biru</b></p>
                                
                                <div class="row align-items-end">
                                    <div class="col-md-4 mb-2">
                                        <label class="small font-weight-bold">Warna</label>
                                        <input type="text" id="inputWarna" class="form-control" placeholder="Contoh: Merah, Hitam">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="small font-weight-bold">Ukuran</label>
                                        <input type="text" id="inputUkuran" class="form-control" placeholder="Contoh: S, M, L">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <button type="button" class="btn btn-primary w-100" onclick="generateKeTabel()">
                                            <i class="fas fa-arrow-down"></i> Tambahkan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Fitur Harga Massal --}}
                        <div class="card card-body bg-white border mb-3 p-2">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto"><small class="fw-bold">Set Massal:</small></div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm">
                                        <input type="number" class="form-control" id="massalHarga" placeholder="Harga Semua">
                                        <button class="btn btn-outline-secondary" type="button" onclick="terapkanMassal('price')">Set</button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-sm">
                                        <input type="number" class="form-control" id="massalStok" placeholder="Stok Semua">
                                        <button class="btn btn-outline-secondary" type="button" onclick="terapkanMassal('stock')">Set</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tabel Variasi --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="20%">Warna</th>
                                        <th width="15%">Ukuran</th>
                                        <th width="25%">Harga (Rp)</th>
                                        <th width="15%">Stok</th>
                                        <th width="20%">SKU (Auto)</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyVariasi">
                                    {{-- Baris akan digenerate di JS --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-warning small mt-2">
                            <i class="fas fa-info-circle"></i> Hapus semua baris untuk kembali ke mode "Single Product".
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                    <a href="{{ route('admin.view-data') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Logic Counter Karakter
document.addEventListener('DOMContentLoaded', function() {
    const deskripsi = document.getElementById('deskripsi');
    const nama = document.getElementById('namaProduk');
    if(deskripsi) deskripsi.addEventListener('input', () => document.getElementById('sisaKarakter').textContent = deskripsi.value.length);
    if(nama) nama.addEventListener('input', () => document.getElementById('sisaKarakterNama').textContent = nama.value.length);
});

// Counter Index Variasi
let currentIndex = 0;

// Fungsi: Aktifkan Mode Variasi
function aktifkanModeVariasi() {
    document.getElementById('single-section').style.display = 'none';
    document.getElementById('variation-section').style.display = 'block';
    
    // Disable input single agar tidak terkirim dan tidak kena validasi
    document.querySelectorAll('.single-input').forEach(el => {
        el.disabled = true;
        el.removeAttribute('required');
    });

    document.getElementById('inputWarna').focus();
}

// Fungsi: Kembali ke Mode Single
function kembaliKeSingle() {
    document.getElementById('single-section').style.display = 'block';
    document.getElementById('variation-section').style.display = 'none';

    // Enable input single
    document.querySelectorAll('.single-input').forEach(el => {
        el.disabled = false;
        el.setAttribute('required', 'required');
    });
}

// Fungsi: Generate Tabel
function generateKeTabel() {
    const rawWarna = document.getElementById('inputWarna').value;
    const rawUkuran = document.getElementById('inputUkuran').value;

    const warnas = rawWarna ? rawWarna.split(',').map(s => s.trim()).filter(s => s !== '') : [];
    const ukurans = rawUkuran ? rawUkuran.split(',').map(s => s.trim()).filter(s => s !== '') : [];

    if (warnas.length === 0 && ukurans.length === 0) {
        alert('Mohon isi minimal Warna atau Ukuran!');
        return;
    }

    const finalWarna = warnas.length > 0 ? warnas : ['-'];
    const finalUkuran = ukurans.length > 0 ? ukurans : ['-'];

    // Ambil nama produk untuk generate SKU
    let prodName = document.getElementById('namaProduk').value || 'PROD';
    // Ambil 3 huruf pertama, uppercase, buang spasi/karakter aneh
    prodName = prodName.replace(/[^a-zA-Z0-9]/g, '').substring(0,3).toUpperCase();

    finalWarna.forEach(w => {
        finalUkuran.forEach(u => {
            tambahBaris(w, u, prodName);
        });
    });

    // Reset Input
    document.getElementById('inputWarna').value = '';
    document.getElementById('inputUkuran').value = '';
    
    cekKondisiTabel();
}

// Fungsi: Tambah baris ke Tabel
function tambahBaris(warna, ukuran, prodCode) {
    const valWarna = warna === '-' ? '' : warna;
    const valUkuran = ukuran === '-' ? '' : ukuran;
    
    // Generate SKU Otomatis: SKU-XXX-WARNA-SIZE
    const skuCode = `SKU-${prodCode}-${valWarna.substring(0,3)}-${valUkuran}`.toUpperCase().replace(/\s+/g, '');

    const tbody = document.getElementById('bodyVariasi');
    const tr = document.createElement('tr');
    
    tr.innerHTML = `
        <td><input type="text" name="variations[${currentIndex}][color]" class="form-control var-input" value="${valWarna}" required></td>
        <td><input type="text" name="variations[${currentIndex}][size]" class="form-control var-input" value="${valUkuran}" required></td>
        <td><input type="number" name="variations[${currentIndex}][price]" class="form-control var-input input-harga-massal" placeholder="0" required></td>
        <td><input type="number" name="variations[${currentIndex}][stock]" class="form-control var-input input-stok-massal" placeholder="0" required></td>
        
        {{-- Input SKU Otomatis --}}
        <td><input type="text" name="variations[${currentIndex}][sku]" class="form-control var-input bg-light" value="${skuCode}" readonly></td>
        
        <td class="text-center">
             <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)"><i class="fas fa-trash"></i></button>
        </td>
    `;
    
    tbody.appendChild(tr);
    currentIndex++; 
}

// Fungsi: Hapus Baris
function hapusBaris(btn) {
    const row = btn.closest('tr');
    row.remove();
    cekKondisiTabel();
}

// Fungsi: Cek apakah tabel kosong
function cekKondisiTabel() {
    const tbody = document.getElementById('bodyVariasi');
    if (tbody.children.length === 0) {
        kembaliKeSingle();
    } else {
        if(document.getElementById('variation-section').style.display === 'none') {
            aktifkanModeVariasi();
        }
    }
}

// Fungsi: Set Harga/Stok Massal
function terapkanMassal(type) {
    if(type === 'price') {
        const val = document.getElementById('massalHarga').value;
        if(val) document.querySelectorAll('.input-harga-massal').forEach(el => el.value = val);
    } else {
        const val = document.getElementById('massalStok').value;
        if(val) document.querySelectorAll('.input-stok-massal').forEach(el => el.value = val);
    }
}
</script>
@endsection