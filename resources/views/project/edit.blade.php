@extends('layout.template-admin')

@section('content')
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit Data Produk</h6>
    </div>
    <div class="card-body">

      <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="formEditProduk">
        @csrf
        @method('PUT')
        <input type="hidden" id="productId" value="{{ $product->id }}">
        
        {{-- BAGIAN 1: INFORMASI DASAR --}}
        <div class="mb-4 pb-4 border-bottom">
          <h5 class="mb-3">Informasi Product</h5>
          
          <div class="mb-3">
            <label for="namaProduk" class="form-label">Nama Produk<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="namaProduk" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
            <div class="form-text text-end"><span id="sisaKarakterNama">{{ strlen($product->product_name) }}</span>/225</div>
          </div>
          
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori<span class="text-danger">*</span></label>
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

          <div class="mb-3">
            <label for="status" class="form-label">Status Produk<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-select" required>
              <option value="show" {{ old('status', $product->status) == 'show' ? 'selected' : '' }}>Tampilkan</option>
              <option value="archive" {{ old('status', $product->status) == 'archive' ? 'selected' : '' }}>Arsipkan</option>
            </select>
          </div>
        </div>

        {{-- BAGIAN 2: GAMBAR PRODUK --}}
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
            <input type="file" class="form-control" id="image" name="image[]" multiple accept="image/png, image/jpeg, image/jpg">
            <small class="text-muted">Ukuran maksimal 2MB. Format: JPG, JPEG, PNG.</small>
          </div>
        </div>

        {{-- BAGIAN 3: VARIASI & HARGA --}}
        <div class="mb-4">
          <h5 class="mb-3">Harga & Stok (Variasi)</h5>
          
          {{-- Cek apakah produk ini punya variasi di database --}}
          @php
            $hasVariations = $product->product_variation->count() > 1 || 
                ($product->product_variation->count() == 1 && $product->product_variation->first()->color != null);
            $singleVariation = !$hasVariations ? $product->product_variation->first() : null;
          @endphp

          {{-- A. INPUT SINGLE PRODUCT (Jika tidak ada variasi) --}}
          <div id="single-section" class="card card-body bg-light mb-3" style="{{ $hasVariations ? 'display:none' : '' }}">
            <div class="row">
              <div class="col-md-6">
                <label>Harga Satuan (Rp)*</label>
                <input type="number" name="price" id="singlePrice" class="form-control single-input" 
                       value="{{ $singleVariation->price ?? '' }}" {{ $hasVariations ? 'disabled' : 'required' }}>
              </div>
              <div class="col-md-6">
                <label>Stok Total*</label>
                <input type="number" name="stock" id="singleStock" class="form-control single-input" 
                       value="{{ $singleVariation->stock ?? '' }}" {{ $hasVariations ? 'disabled' : 'required' }}>
              </div>
            </div>
            <div class="mt-3 text-center">
              <span class="text-muted small">Ingin produk ini punya pilihan warna/ukuran?</span><br>
              <button type="button" class="btn btn-sm btn-primary mt-1" onclick="aktifkanModeVariasi()">
                <i class="fas fa-list"></i> Aktifkan Variasi Produk
              </button>
            </div>
          </div>

          {{-- B. INPUT VARIATION MODE --}}
          <div id="variation-section" style="{{ !$hasVariations ? 'display:none' : '' }}">
            
            <div class="card bg-light mb-3 border-primary">
              <div class="card-body py-3">
                <h6 class="text-primary font-weight-bold"><i class="fas fa-plus-circle"></i> Tambah Variasi Baru</h6>
                <p class="small text-muted mb-2">Ketik warna/ukuran dipisahkan koma (contoh: Merah, Biru). Data lama tidak akan hilang.</p>
                
                <div class="row align-items-end">
                  <div class="col-md-4 mb-2">
                    <label class="small font-weight-bold">Opsi Warna</label>
                    <input type="text" id="inputWarna" class="form-control" placeholder="Contoh: Merah, Biru">
                  </div>
                  <div class="col-md-4 mb-2">
                    <label class="small font-weight-bold">Opsi Ukuran</label>
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

            {{-- Tabel Variasi --}}
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="tabelVariasi">
                <thead class="table-light">
                  <tr>
                    <th width="20%">Warna</th>
                    <th width="20%">Ukuran</th>
                    <th width="25%">Harga (Rp)</th>
                    <th width="15%">Stok</th>
                    <th width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody id="bodyVariasi">
                  {{-- Variasi Lama dari Database --}}
                  @if($hasVariations)
                    @foreach($product->product_variation as $idx => $v)
                      <tr>
                        {{-- Hidden ID --}}
                        <input type="hidden" name="variations[{{ $idx }}][id]" value="{{ $v->id }}">
                        
                        <td><input type="text" name="variations[{{ $idx }}][color]" class="form-control var-input" value="{{ $v->color }}" required></td>
                        <td><input type="text" name="variations[{{ $idx }}][size]" class="form-control var-input" value="{{ $v->size }}" required></td>
                        <td><input type="number" name="variations[{{ $idx }}][price]" class="form-control var-input" value="{{ $v->price }}" required></td>
                        <td><input type="number" name="variations[{{ $idx }}][stock]" class="form-control var-input" value="{{ $v->stock }}" required></td>
                        <td class="text-center">
                          <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>

            <div class="alert alert-warning small mt-2">
              <i class="fas fa-exclamation-triangle"></i> Jika semua baris dihapus, produk akan kembali menjadi "Single Product".
            </div>
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
          <a href="{{ route('admin.view-data') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// Logic Counter Karakter
function updateCounter() {
  const deskripsi = document.getElementById('deskripsi');
  const nama = document.getElementById('namaProduk');
  if(deskripsi) deskripsi.addEventListener('input', () => document.getElementById('sisaKarakter').textContent = deskripsi.value.length);
  if(nama) nama.addEventListener('input', () => document.getElementById('sisaKarakterNama').textContent = nama.value.length);
}

// Global Index agar name="variations[i]" tidak bentrok
let currentIndex = {{ $product->product_variation->count() }}; 

document.addEventListener('DOMContentLoaded', function() {
    updateCounter();
    cekKondisiTabel();
});

// Fungsi Switch ke Mode Variasi
function aktifkanModeVariasi() {
    document.getElementById('single-section').style.display = 'none';
    document.getElementById('variation-section').style.display = 'block';
    
    // Matikan input single
    document.querySelectorAll('.single-input').forEach(el => {
        el.disabled = true;
        el.removeAttribute('required');
    });

    // Fokus ke input
    if(document.getElementById('bodyVariasi').children.length === 0) {
        document.getElementById('inputWarna').focus();
    }
}

// Fungsi Switch ke Mode Single
function kembaliKeSingle() {
    document.getElementById('single-section').style.display = 'block';
    document.getElementById('variation-section').style.display = 'none';

    // Nyalakan input single
    document.querySelectorAll('.single-input').forEach(el => {
        el.disabled = false;
        el.setAttribute('required', 'required');
    });

    // Matikan input variasi (jaga-jaga)
    document.querySelectorAll('.var-input').forEach(el => el.disabled = true);
}

// Generator Variasi (Warna x Ukuran)
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

    finalWarna.forEach(w => {
        finalUkuran.forEach(u => {
            tambahBaris(w, u);
        });
    });

    // Bersihkan input
    document.getElementById('inputWarna').value = '';
    document.getElementById('inputUkuran').value = '';
    
    cekKondisiTabel();
}

// Tambah baris ke HTML (Append)
function tambahBaris(warna, ukuran) {
    const valWarna = warna === '-' ? '' : warna;
    const valUkuran = ukuran === '-' ? '' : ukuran;
    
    const tbody = document.getElementById('bodyVariasi');
    const tr = document.createElement('tr');
    
    tr.innerHTML = `
        <td><input type="text" name="variations[${currentIndex}][color]" class="form-control var-input" value="${valWarna}" required></td>
        <td><input type="text" name="variations[${currentIndex}][size]" class="form-control var-input" value="${valUkuran}" required></td>
        <td><input type="number" name="variations[${currentIndex}][price]" class="form-control var-input" placeholder="0" required></td>
        <td><input type="number" name="variations[${currentIndex}][stock]" class="form-control var-input" placeholder="0" required></td>
        <td class="text-center">
             <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)"><i class="fas fa-trash"></i></button>
        </td>
    `;
    
    tbody.appendChild(tr);
    currentIndex++; 
}

function hapusBaris(btn) {
    if(!confirm('Hapus variasi ini?')) return;
    const row = btn.closest('tr');
    row.remove();
    cekKondisiTabel();
}

function cekKondisiTabel() {
    const tbody = document.getElementById('bodyVariasi');
    const rowCount = tbody.children.length;

    if (rowCount === 0) {
        kembaliKeSingle();
    } else {
        if(document.getElementById('variation-section').style.display === 'none') {
            aktifkanModeVariasi();
        }
        document.querySelectorAll('.var-input').forEach(el => {
            el.disabled = false;
        });
    }
}
</script>
@endsection