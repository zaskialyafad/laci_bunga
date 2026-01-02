@extends('layout.template-admin')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Produk</h6>
        </div>
        <div class="card-body">
            {{-- Penampil Pesan Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('project.simpanProduk') }}" method="POST" enctype="multipart/form-data" id="formTambahProduk">
                @csrf
                <input type="hidden" id="productId" value="">
                
                {{-- Informasi Produk --}}
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
                            <option value="show" selected>Tampilkan</option>
                            <option value="archive">Arsipkan</option>
                        </select>
                        <small class="text-muted">"Arsipkan" akan menyimpan produk tapi tidak ditampilkan</small>
                    </div>
                </div>

                {{-- Gambar produk --}}
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Gambar Produk</h5>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Gambar Produk<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple required>
                        <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG. Maksimal 9 gambar.</small>
                    </div>
                </div>

                {{-- Section Variasi --}}
                <div class="mb-4 pb-4 border-bottom">
                    <h5 class="mb-3">Variasi Produk</h5>

                    {{-- Input Tunggal (Default) --}}
                    <div id="singleProductInputs">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price">Harga Produk*</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stock">Stok Produk*</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-primary mt-2" id="btnTambahVariasi" onclick="tampilkanVariasiBaru()">
                        + Tambah Variasi Produk
                    </button>

                    {{-- Container Variasi Baru --}}
                    <div id="variasiBaruSection" style="display: none;" class="mt-3">
                        <div class="card bg-light p-3 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6><i class="fas fa-cogs"></i> Pengaturan Variasi Baru</h6>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="batalTambahVariasi()">
                                    <i class="fas fa-times"></i> Batal
                                </button>
                            </div>

                            <div id="variasiContainer"></div>

                            <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="tambahGrupVariasi()">
                                + Tambah Grup Variasi
                            </button>

                            <div id="tabelVariasiBaru" style="display: none;">
                                <div class="alert alert-primary mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <label class="small">Harga Massal:</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="hargaMassal" placeholder="0">
                                                <button type="button" class="btn btn-primary" onclick="terapkanHargaMassal()">Set</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small">Stok Massal:</label>
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control" id="stokMassal" placeholder="0">
                                                <button type="button" class="btn btn-primary" onclick="terapkanStokMassal()">Set</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm bg-white">
                                        <thead class="table-light">
                                            <tr><th>Warna</th><th>Ukuran</th><th>Harga</th><th>Stok</th><th>SKU</th></tr>
                                        </thead>
                                        <tbody id="tabelVariasiBody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                    <a href="{{ route('project.view-data') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let jumlahGrup = 0;
let dataVariasi = {};

document.addEventListener('DOMContentLoaded', function() {
    const deskripsi = document.getElementById('deskripsi');
    const nama = document.getElementById('namaProduk');
    
    if(deskripsi) deskripsi.addEventListener('input', () => document.getElementById('sisaKarakter').textContent = deskripsi.value.length);
    if(nama) nama.addEventListener('input', () => document.getElementById('sisaKarakterNama').textContent = nama.value.length);
});

function tampilkanVariasiBaru() {
    document.getElementById('variasiBaruSection').style.display = 'block';
    document.getElementById('btnTambahVariasi').style.display = 'none';
    document.getElementById('singleProductInputs').style.display = 'none';
    
    // Disable input utama
    const p = document.getElementById('price'), s = document.getElementById('stock');
    p.disabled = true; p.removeAttribute('required');
    s.disabled = true; s.removeAttribute('required');

    if(Object.keys(dataVariasi).length === 0) tambahGrupVariasi();
}

function batalTambahVariasi() {
    if(!confirm('Batalkan penggunaan variasi?')) return;
    dataVariasi = {};
    document.getElementById('variasiBaruSection').style.display = 'none';
    document.getElementById('variasiContainer').innerHTML = '';
    document.getElementById('btnTambahVariasi').style.display = 'block';
    document.getElementById('singleProductInputs').style.display = 'block';
    
    const p = document.getElementById('price'), s = document.getElementById('stock');
    p.disabled = false; p.setAttribute('required', 'required');
    s.disabled = false; s.setAttribute('required', 'required');
}

function tambahGrupVariasi() {
    jumlahGrup++;
    const id = `grup_${jumlahGrup}`;
    dataVariasi[id] = { colors: [], sizes: [] };
    
    const div = document.createElement('div');
    div.className = 'border p-3 mb-3 bg-white rounded shadow-sm';
    div.id = id;
    div.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>Grup Variasi ${jumlahGrup}</strong>
            <button type="button" class="btn btn-sm btn-danger" onclick="hapusGrup('${id}')"><i class="fas fa-trash"></i></button>
        </div>
        <div class="row">
            <div class="col-md-6 border-right">
                <label class="small fw-bold">Pilihan Warna:</label>
                <div id="${id}_c"></div>
                <button type="button" class="btn btn-sm btn-link p-0" onclick="tambahOpsi('${id}','colors')">+ Tambah Warna</button>
            </div>
            <div class="col-md-6">
                <label class="small fw-bold">Pilihan Ukuran:</label>
                <div id="${id}_s"></div>
                <button type="button" class="btn btn-sm btn-link p-0" onclick="tambahOpsi('${id}','sizes')">+ Tambah Ukuran</button>
            </div>
        </div>
    `;
    document.getElementById('variasiContainer').appendChild(div);
    tambahOpsi(id, 'colors'); 
    tambahOpsi(id, 'sizes');
}

function tambahOpsi(gId, type) {
    const ts = Date.now(), oId = `${gId}_${ts}`;
    const container = document.getElementById(type === 'colors' ? `${gId}_c` : `${gId}_s`);
    
    const div = document.createElement('div');
    div.className = 'input-group input-group-sm mb-1';
    div.id = oId;
    div.innerHTML = `
        <input type="text" class="form-control" placeholder="..." onchange="updateOpsi('${gId}','${type}','${oId}',this.value)" required>
        <button type="button" class="btn btn-danger" onclick="hapusOpsi('${gId}','${type}','${oId}')">x</button>
    `;
    container.appendChild(div);
    dataVariasi[gId][type].push({id: oId, val: ''});
}

function updateOpsi(gId, type, oId, val) {
    const obj = dataVariasi[gId][type].find(o => o.id === oId);
    if(obj) { obj.val = val.trim(); renderTabel(); }
}

function hapusOpsi(gId, type, oId) {
    if (dataVariasi[gId][type].length <= 1) return alert('Minimal 1 opsi!');
    document.getElementById(oId).remove();
    dataVariasi[gId][type] = dataVariasi[gId][type].filter(o => o.id !== oId);
    renderTabel();
}

function hapusGrup(gId) {
    if(!confirm('Hapus grup ini?')) return;
    document.getElementById(gId).remove();
    delete dataVariasi[gId];
    renderTabel();
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
                    <td><input type="number" name="variations[${idx}][price]" class="form-control form-control-sm input-harga" required></td>
                    <td><input type="number" name="variations[${idx}][stock]" class="form-control form-control-sm input-stok" required></td>
                    <td><input type="text" name="variations[${idx}][sku]" class="form-control form-control-sm" value="${sku}" readonly></td>
                </tr>`;
                idx++;
            });
        });
    });
    document.getElementById('tabelVariasiBody').innerHTML = html;
}

function terapkanHargaMassal() {
    const v = document.getElementById('hargaMassal').value;
    if(v) document.querySelectorAll('.input-harga').forEach(i => i.value = v);
}

function terapkanStokMassal() {
    const v = document.getElementById('stokMassal').value;
    if(v) document.querySelectorAll('.input-stok').forEach(i => i.value = v);
}
</script>
@endsection