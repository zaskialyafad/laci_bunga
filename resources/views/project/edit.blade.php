@extends('layout.template-admin')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Produk</h6>
        </div>
        <div class="card-body">
            {{-- Bagian Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 1. Perbaikan Tanda Kutip di Form Action --}}
            <form action="{{ route('project.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="formEditProduk">
                @csrf
                @method('PUT')
                <input type="hidden" id="productId" value="{{ $product->id }}">
                
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Informasi Product</h5>
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="namaProduk" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                        <div class="form-text text-end"><span id="sisaKarakterNama">{{ strlen($product->product_name) }}</span>/225</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori<span class="text-danger">*</span></label>
                        <select name="category_id" id="kategori" class="form-select" required>
                            <option value="">--Pilih Kategori--</option>
                            @foreach ($category as $c)
                                <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="deskripsi" name="description" required>{{ old('description', $product->description) }}</textarea>
                        <div class="form-text text-end"><span id="sisaKarakter">{{ strlen($product->description) }}</span>/3000</div>
                    </div>

                    {{-- 2. Sesuaikan value status dengan ENUM di Database --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Produk<span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="show" {{ old('status', $product->status) == 'show' ? 'selected' : '' }}>Tampilkan</option>
                            <option value="archive" {{ old('status', $product->status) == 'archive' ? 'selected' : '' }}>Arsipkan</option>
                        </select>
                    </div>
                </div>

                {{-- Gambar --}}
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Gambar Produk</h5>
                    @if($product->gambar_produk->count() > 0)
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini:</label>
                            <div class="row">
                                @foreach($product->gambar_produk as $img)
                                    <div class="col-md-2 mb-2 text-center">
                                        <img src="{{ asset('storage/productsImg/'.$img->image) }}" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                        @if($img->is_primary) <span class="badge bg-primary d-block mt-1">Utama</span> @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Gambar Baru (Opsional)</label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple>
                        <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG.</small>
                    </div>
                </div>

                {{-- Variasi --}}
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Variasi Produk</h5>
                    @php
                        $hasVariations = $product->product_variation->count() > 1 || 
                                         ($product->product_variation->count() == 1 && $product->product_variation->first()->color != null);
                        $singleVariation = !$hasVariations ? $product->product_variation->first() : null;
                    @endphp

                    <div id="singleProductInputs" style="{{ $hasVariations ? 'display: none;' : '' }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price">Harga Produk*</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $singleVariation->price ?? '' }}" {{ $hasVariations ? 'disabled' : 'required' }}>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock">Stok Produk*</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ $singleVariation->stock ?? '' }}" {{ $hasVariations ? 'disabled' : 'required' }}>
                            </div>
                        </div>
                    </div>

                    @if($hasVariations)
                        <div id="existingVariationsSection">
                            <div class="alert alert-info">Edit variasi di bawah atau hapus semua untuk kembali ke harga tunggal.</div>
                            <button type="button" class="btn btn-outline-danger btn-sm mb-3" onclick="hapusSemuaVariasiExisting()">Hapus Semua Variasi</button>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr><th>Warna</th><th>Ukuran</th><th>Harga</th><th>Stok</th><th>SKU</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->product_variation as $idx => $v)
                                            <tr>
                                                <td><input type="text" name="variations[{{ $idx }}][color]" class="form-control existing-input" value="{{ $v->color }}" required></td>
                                                <td><input type="text" name="variations[{{ $idx }}][size]" class="form-control existing-input" value="{{ $v->size }}" required></td>
                                                <td><input type="number" name="variations[{{ $idx }}][price]" class="form-control existing-input" value="{{ $v->price }}" required></td>
                                                <td><input type="number" name="variations[{{ $idx }}][stock]" class="form-control existing-input" value="{{ $v->stock }}" required></td>
                                                <td><input type="text" name="variations[{{ $idx }}][sku]" class="form-control" value="{{ $v->sku }}" readonly></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <button type="button" class="btn btn-outline-primary mt-2" id="btnTambahVariasiBaru" onclick="tampilkanVariasiBaru()">+ Tambah Variasi Baru</button>

                    <div id="variasiBaruSection" style="display: none;" class="mt-3">
                        <div class="card bg-light p-3">
                            <h6>Pengaturan Variasi Baru</h6>
                            <div id="variasiContainer"></div>
                            <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="tambahGrupVariasi()">+ Tambah Grup</button>
                            <div id="tabelVariasiBaru" style="display: none;">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light"><tr><th>Warna</th><th>Ukuran</th><th>Harga</th><th>Stok</th><th>SKU</th></tr></thead>
                                    <tbody id="tabelVariasiBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Produk</button>
                    <a href="{{ route('project.view-data') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let jumlahGrup = 0;
let dataVariasi = {};

// 3. Perbaikan Script Counter Karakter
function updateCounter() {
    const deskripsi = document.getElementById('deskripsi');
    const nama = document.getElementById('namaProduk');
    if(deskripsi) deskripsi.addEventListener('input', () => document.getElementById('sisaKarakter').textContent = deskripsi.value.length);
    if(nama) nama.addEventListener('input', () => document.getElementById('sisaKarakterNama').textContent = nama.value.length);
}
document.addEventListener('DOMContentLoaded', updateCounter);

function tampilkanVariasiBaru() {
    if(!confirm('Menambah variasi baru akan menimpa data variasi lama saat disimpan. Lanjutkan?')) return;
    document.getElementById('variasiBaruSection').style.display = 'block';
    document.getElementById('btnTambahVariasiBaru').style.display = 'none';
    if(document.getElementById('existingVariationsSection')) document.getElementById('existingVariationsSection').style.display = 'none';
    document.querySelectorAll('.existing-input').forEach(i => i.disabled = true);
    document.getElementById('singleProductInputs').style.display = 'none';
    disableUtama();
    if(Object.keys(dataVariasi).length === 0) tambahGrupVariasi();
}

function disableUtama() {
    const p = document.getElementById('price'), s = document.getElementById('stock');
    if(p){ p.disabled = true; p.removeAttribute('required'); }
    if(s){ s.disabled = true; s.removeAttribute('required'); }
}

function tambahGrupVariasi() {
    jumlahGrup++;
    const id = `grup_${jumlahGrup}`;
    dataVariasi[id] = { colors: [], sizes: [] };
    const div = document.createElement('div');
    div.className = 'border p-2 mb-2 bg-white rounded';
    div.id = id;
    div.innerHTML = `
        <div class="d-flex justify-content-between"><strong>Grup ${jumlahGrup}</strong><button type="button" class="btn btn-sm text-danger" onclick="hapusGrup('${id}')">x</button></div>
        <div class="mb-2"><label class="small">Warna:</label><div id="${id}_c"></div><button type="button" class="btn btn-sm btn-link py-0" onclick="tambahOpsi('${id}','colors')">+ Warna</button></div>
        <div class="mb-2"><label class="small">Ukuran:</label><div id="${id}_s"></div><button type="button" class="btn btn-sm btn-link py-0" onclick="tambahOpsi('${id}','sizes')">+ Ukuran</button></div>
    `;
    document.getElementById('variasiContainer').appendChild(div);
    tambahOpsi(id, 'colors'); tambahOpsi(id, 'sizes');
}

function tambahOpsi(gId, type) {
    const ts = Date.now(), oId = `${gId}_${ts}`;
    const container = document.getElementById(type === 'colors' ? `${gId}_c` : `${gId}_s`);
    const div = document.createElement('div');
    div.className = 'input-group input-group-sm mb-1';
    div.id = oId;
    div.innerHTML = `<input type="text" class="form-control" placeholder="..." onchange="updateOpsi('${gId}','${type}','${oId}',this.value)" required><button type="button" class="btn btn-danger" onclick="hapusOpsi('${gId}','${type}','${oId}')">x</button>`;
    container.appendChild(div);
    dataVariasi[gId][type].push({id: oId, val: ''});
}

function updateOpsi(gId, type, oId, val) {
    const obj = dataVariasi[gId][type].find(o => o.id === oId);
    if(obj) { obj.val = val.trim(); renderTabel(); }
}

function renderTabel() {
    const validGrup = Object.values(dataVariasi).filter(g => g.colors.some(c => c.val) && g.sizes.some(s => s.val));
    const tabSection = document.getElementById('tabelVariasiBaru');
    if(validGrup.length === 0) { tabSection.style.display = 'none'; return; }
    tabSection.style.display = 'block';

    let html = '', idx = 0;
    const prodName = (document.getElementById('namaProduk').value || 'PROD').substring(0,3).toUpperCase();

    validGrup.forEach(g => {
        g.colors.filter(c => c.val).forEach(c => {
            g.sizes.filter(s => s.val).forEach(s => {
                const sku = `SKU-${prodName}-${c.val}-${s.val}`.toUpperCase().replace(/\s+/g, '-');
                html += `<tr>
                    <td>${c.val}<input type="hidden" name="variations[${idx}][color]" value="${c.val}"></td>
                    <td>${s.val}<input type="hidden" name="variations[${idx}][size]" value="${s.val}"></td>
                    <td><input type="number" name="variations[${idx}][price]" class="form-control form-control-sm" required></td>
                    <td><input type="number" name="variations[${idx}][stock]" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="variations[${idx}][sku]" class="form-control form-control-sm" value="${sku}" readonly></td>
                </tr>`;
                idx++;
            });
        });
    });
    document.getElementById('tabelVariasiBody').innerHTML = html;
}

function hapusSemuaVariasiExisting() {
    if(!confirm('Hapus semua variasi lama?')) return;
    document.getElementById('existingVariationsSection').style.display = 'none';
    document.querySelectorAll('.existing-input').forEach(i => { i.disabled = true; i.removeAttribute('required'); });
    document.getElementById('singleProductInputs').style.display = 'block';
    const p = document.getElementById('price'), s = document.getElementById('stock');
    p.disabled = false; p.setAttribute('required', 'required');
    s.disabled = false; s.setAttribute('required', 'required');
}

// Fungsi untuk menghapus satu grup variasi utuh
function hapusGrup(gId) {
    if(!confirm('Hapus grup variasi ini?')) return;
    
    // Hapus elemen dari layar
    const element = document.getElementById(gId);
    if (element) element.remove();
    
    // Hapus data dari objek dataVariasi
    delete dataVariasi[gId];
    
    // Render ulang tabel kombinasi
    renderTabel();
}

// Fungsi untuk menghapus opsi spesifik (Warna atau Ukuran)
function hapusOpsi(gId, type, oId) {
    // Jangan hapus jika itu satu-satunya opsi yang tersisa (minimal harus ada 1)
    if (dataVariasi[gId][type].length <= 1) {
        alert('Minimal harus ada satu opsi!');
        return;
    }

    // Hapus elemen dari layar
    const element = document.getElementById(oId);
    if (element) element.remove();
    
    // Filter data keluar dari objek
    dataVariasi[gId][type] = dataVariasi[gId][type].filter(o => o.id !== oId);
    
    // Render ulang tabel kombinasi
    renderTabel();
}

// Fungsi batal tambah variasi secara keseluruhan
function batalTambahVariasi() {
    if (!confirm('Apakah Anda yakin ingin membatalkan penambahan variasi baru?')) {
        return;
    }
    
    // Reset objek data
    dataVariasi = {};
    jumlahGrup = 0;

    // Sembunyikan section variasi baru
    document.getElementById('variasiBaruSection').style.display = 'none';
    
    // Munculkan kembali tombol "+ Tambah Variasi Baru"
    document.getElementById('btnTambahVariasiBaru').style.display = 'inline-block';

    // Tampilkan kembali section variasi lama (jika ada) atau input tunggal
    const existingSec = document.getElementById('existingVariationsSection');
    if (existingSec) {
        existingSec.style.display = 'block';
        // Aktifkan kembali input lama agar terkirim ke server
        document.querySelectorAll('.existing-input').forEach(i => {
            i.disabled = false;
            i.setAttribute('required', 'required');
        });
    } else {
        const singleSec = document.getElementById('singleProductInputs');
        if (singleSec) {
            singleSec.style.display = 'block';
            enableUtama(); // Fungsi yang mengaktifkan input harga/stok tunggal
        }
    }
}

</script>
@endsection