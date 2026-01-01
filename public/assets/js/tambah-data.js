let jumlahVariasi = 0;
let variasi={};

document.addEventListener('DOMContentLoaded', function() {
    penghitungKarakter();
    tambahVariasiButton();
});

// Fungsi penghitung karakter
function penghitungKarakter() {
    const deskripsi = document.getElementById('deskripsi');
    const namaProduk = document.getElementById('namaProduk');

    if (deskripsi) {
        deskripsi.addEventListener('input', function() {
            const karakter = deskripsi.value.length;
            document.getElementById('sisaKarakter').textContent = karakter; 
        });
    }

    if (namaProduk) {
        namaProduk.addEventListener('input', function() {
            const karakter = namaProduk.value.length;
            document.getElementById('sisaKarakterNama').textContent = karakter;
        });
    }
}


// Fungsi menampilkan section variasi
function tambahVariasiButton() {
    const btnTambahVariasi = document.getElementById('btnTambahVariasi');
    
    if (btnTambahVariasi) {
        btnTambahVariasi.addEventListener('click', function() {
            tampilkanVariasiSection();
        });
    }
}

// Tampilkan section variasi
function tampilkanVariasiSection() {
    const variasiSection = document.getElementById('variasiSection');
    const btnTambahVariasi = document.getElementById('btnTambahVariasi');

    // menyembunyikan tombol "Tambah Variasi"
    if (btnTambahVariasi) {
        btnTambahVariasi.style.display = 'none';
    }

    // tampilkan section variasi
    if (variasiSection) {
        variasiSection.style.display = 'block';
    }

    // panggil fungsi disable input produk utama (agar sistem tidak bingung kalau ada 2 input harga, stok, dll)
    disableInputProdukUtama();

    // menambahkan variasi pertama secara default
    if(Object.keys(variasi).length === 0){
        tambahVariasiLainnya();
    }
}

// menonaktifkan input produk utama
function disableInputProdukUtama() {
    const price=document.getElementById('price');
    const stock=document.getElementById('stock');
    const sku=document.getElementById('sku');

    if(price){
        price.value = '';
        price.removeAttribute('required');
        price.disabled = true;
    }

    if(stock){
        stock.value = '';
        stock.removeAttribute('required');
        stock.disabled = true;
    }

    if(sku){
        sku.disabled = true;
    }
}

// mengaktifkan input produk utama
function enableInputProdukUtama() {
    const price=document.getElementById('price');
    const stock=document.getElementById('stock');
    const sku=document.getElementById('sku');

    if(price){
        price.setAttribute('required', 'required');
        price.disabled = false;
    }
    if(stock){
        stock.setAttribute('required', 'required');
        stock.disabled = false;
    }   
    if(sku){
        sku.disabled = false;
    }
}

// Fungsi Hapus Semua Variasi
function hapusSemuaVariasi() {
    // konfirmasi hapus, kalau tidak yakin, akan distop
    if (!confirm('Apakah Anda yakin ingin menghapus semua variasi?')) {
        return
    }
    // reset variasi
    variasi = {};
    jumlahVariasi = 0;

    // sembunyikan section
    const variasiSection = document.getElementById('variasiSection');
    const btnTambahVariasi = document.getElementById('btnTambahVariasi');
    const variasiContainer = document.getElementById('variasiContainer');
    const tabelVariasi = document.getElementById('tabelVariasi');

    if (variasiSection) {
        variasiSection.style.display = 'none';
    }

    if (btnTambahVariasi) {
        btnTambahVariasi.style.display = 'inline-block';
    }

    if (variasiContainer) {
        variasiContainer.innerHTML = '';
    }

    if (tabelVariasi) {
        tabelVariasi.style.display = 'none';
    }

    // mengaktifkan kembali input produk utama
    enableInputProdukUtama();
}

// Fungsi Tambah Variasi Lainnya
function tambahVariasiLainnya() {
    jumlahVariasi ++;
    const idVariasi = `variasi${jumlahVariasi}`;

    // menambahkan variasi baru ke objek variasi
    variasi [idVariasi] = {
        color: [],
        size: [],
    }

    const variasiContainer = document.getElementById('variasiContainer');
    if (!variasiContainer) return;

    const div = document.createElement('div');
    div.className = 'variation-card mb-3 p-3 border rounded';
    div.id = idVariasi;
    div.innerHTML = `
        <div class="d-flex justify-content-between align-content-center mb-3">
            <h6 class="mb-0">Variasi ${jumlahVariasi}</h6>
            <button onclick="hapusVariasi('${idVariasi}')">
                <i class="fas fa-trash"> </i> Hapus Variasi
            </button>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Warna Warna <span class="text-danger">*</span></label>
            <div id="${idVariasi}-color-container">
            </div>
            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="tambahOpsiColor('${idVariasi}')"> 
                + Tambah Warna
            </button>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Ukuran <span class="text-danger">*</span></label>
            <div id="${idVariasi}-size-container">
            </div>
            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="tambahOpsiUkuran('${idVariasi}')"> 
                + Tambah Ukuran
            </button>
        </div>
    `;
        
    variasiContainer.appendChild(div);
    tambahOpsiColor(idVariasi);
    tambahOpsiUkuran(idVariasi);
}

// Tambah Opsi Warna
function tambahOpsiColor(idVariasi) {
    const timestamp = Date.now();
    const idOpsi = `${idVariasi}_color_${timestamp}`;
    const container = document.getElementById(`${idVariasi}-color-container`);

    if (!container) return;
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.id = idOpsi;
    div.innerHTML = `
        <input type="text" class="form-control" placeholder="Masukkan warna" onchange="updateOpsiWarna('${idVariasi}', '${idOpsi}', this.value)" required>
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusOpsiWarna('${idVariasi}', '${idOpsi}')">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);

    variasi[idVariasi].color.push({id: idOpsi, value: ''});
}

// Tambah Opsi Ukuran
function tambahOpsiUkuran(idVariasi) {
    const timestamp = Date.now();
    const idOpsi = `${idVariasi}_size_${timestamp}`;
    const container = document.getElementById(`${idVariasi}-size-container`);

    if (!container) return;
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.id = idOpsi;
    div.innerHTML = `
        <input type="text" class="form-control" placeholder="Masukkan ukuran" onchange="updateOpsiUkuran('${idVariasi}', '${idOpsi}', this.value)" required>
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusOpsiUkuran('${idVariasi}', '${idOpsi}')">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(div);
    
    variasi[idVariasi].size.push({id: idOpsi, value: ''});
}

// fungsi update opsi warna
function updateOpsiWarna(idVariasi, idOpsi, value) {
    if (variasi[idVariasi]) {
        const opsi = variasi[idVariasi].color.find(c => c.id === idOpsi);
        if (opsi) {
            opsi.value = value.trim();
            generateTabelVariasi();
        }
    }
}

// fungsi update opsi ukuran
function updateOpsiUkuran(idVariasi, idOpsi, value) {
    if (variasi[idVariasi]) {
        const opsi = variasi[idVariasi].size.find(s => s.id === idOpsi);
        if (opsi) {
            opsi.value = value.trim();
            generateTabelVariasi();
        }
    }
}

// fungsi hapus opsi warna
function hapusOpsiWarna(idVariasi, idOpsi) {
    const element = document.getElementById(idOpsi);
    if (element) {
        element.remove();
    }
// menghapus dari objek variasi
    if(variasi[idVariasi]){
        variasi[idVariasi].color = variasi[idVariasi].color.filter(c => c.id !== idOpsi);
        generateTabelVariasi();
    }
}

// fungsi hapus opsi ukuran
function hapusOpsiUkuran(idVariasi, idOpsi) {
    const element = document.getElementById(idOpsi);
    if (element) {
        element.remove();
    }
// menghapus dari objek variasi
    if(variasi[idVariasi]){
        variasi[idVariasi].size = variasi[idVariasi].size.filter(s => s.id !== idOpsi);
        generateTabelVariasi();
    }
}

// Fungsi Hapus Variasi Tertentu
function hapusVariasi(idVariasi) {
    if(!confirm('Hapus variasi ini?')) {
        return;
    } 
    const variasiElement = document.getElementById(idVariasi);
    if (variasiElement) {
        variasiElement.remove();
    }
    delete variasi[idVariasi];

    generateTabelVariasi();
}

// generate tabel variasi
function generateTabelVariasi() {
    // filter variasi yang lengkap (punya warna dan ukuran)
    const variasiLengkap = Object.values(variasi).filter(v => v.color.length > 0 && v.size.length > 0);
    const tabelVariasi = document.getElementById('tabelVariasi');

    // kalau tidak ada variasi lengkap, sembunyikan tabel
    if (variasiLengkap.length === 0) {
        if (tabelVariasi) {
            tabelVariasi.style.display = 'none';
            return;
        }
    }

    // tampilkan tabel
    if (tabelVariasi) {
        tabelVariasi.style.display = 'block';
    }
    const table = document.getElementById('tabelVariasiProduk');
    // agar kalau table tidak ketemu, berhenti
    if (!table) return;

    const thead = table.querySelector('thead tr');
    const tbody = document.getElementById('tabelVariasiBody');

    // agar kalau thead atau tbody tidak ketemu, berhenti
    if (!thead || !tbody) return;

    // reset isi thead dan tbody
    thead.innerHTML = `
        <th>Warna</th>
        <th>Ukuran</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>SKU</th>
    `;

    let semuaKombinasi = [];
    // membuat header tabel berdasarkan variasi lengkap
    variasiLengkap.forEach(v => {
        v.color.forEach(c => {
            v.size.forEach(s => {
                semuaKombinasi.push({color: c.value, size: s.value});
            });
        });
    });
    // mengisi body tabel dengan semua kombinasi variasi
    tbody.innerHTML = semuaKombinasi.map((kombinasi, index) => {
        const productId = document.getElementById('productId').value;
        const kodeUnik = productId ? `LB${productId}` : `NEW`;
        const skuCode = `${kodeUnik}-${kombinasi.color}-${kombinasi.size}`.toUpperCase().replace(/\s+/g, '-');
        return `
            <tr>
                <td>${kombinasi.color}</td>
                <td>${kombinasi.size}</td>
                <td>
                    <input type="number" name="variations[${index}][price]" class="form-control form-control-sm" min="0" required>
                </td>
                <td>
                    <input type="number" name="variations[${index}][stock]" class="form-control form-control-sm" min="0" required>
                </td>
                <td>
                    <input type="text" name="variations[${index}][sku]" class="form-control form-control-sm" value="${skuCode}" readonly>
                    <input type="hidden" name="variations[${index}][color]" value="${kombinasi.color}">
                    <input type="hidden" name="variations[${index}][size]" value="${kombinasi.size}">
                </td>
            </tr>
        `;
    }).join('');
}

// fungsi menerapkan semua harga sama ke semua variasi
function semuaHargaVariasiSama() {
    const hargaSemuaVariasi = document.getElementById('hargaSemuaVariasi');

    if (!hargaSemuaVariasi) return;
    const harga = hargaSemuaVariasi.value;

    if (!harga || harga < 0) {
        alert('Masukkan harga yang valid!');
        return;
    }

    const inputHarga =document.querySelectorAll('.input-harga');
    inputHarga.forEach(input => {
        input.value = harga;
    });

    // format harga rupiah
    const formatHarga = parseInt(harga).toLocaleString('id-ID');
    alert('Harga Rp ${formatHarga} telah diterapkan ke semua variasi!');
}

// validasi form sebelum submit
const form = document.getElementById('formTambahProduk');
if (form) {
    form.addEventListener('submit', function(e) {
        const hasVariation = Object.keys(variasi).length > 0;

        if (hasVariation) {
            const inputHarga = document.querySelectorAll('.input-harga');
            const inputStok = document.querySelectorAll('.input-stok');

            if (inputHarga.length === 0) {
                e.preventDefault();
                alert('Pastikan semua variasi memiliki harga yang diisi dengan benar!');
                return false;
            }

            let allfilled = true;

            inputHarga.forEach(input => {
                if (!input.value || input.value < 0) {
                    allfilled = false;
                }
            });

            inputStok.forEach(input => {
                if (!input.value || input.value < 0) {
                    allfilled = false;
                }
            });

            if (!allfilled) {
                e.preventDefault();
                alert('Mohon isi harga dan stok untuk semua variasi dengan benar!');
                return false;
            }
        }
    });
}