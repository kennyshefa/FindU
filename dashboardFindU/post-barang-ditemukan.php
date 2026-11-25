<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FindU – Post Barang Ditemukan</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap">
<style>
:root{--blue:#2563EB;--ink:#0F172A;--muted:#475569;--line:#E2E8F0;--soft:#E8F0FE}
*{box-sizing:border-box}
body{margin:0;font-family:'Poppins',system-ui,sans-serif;background:#fff;color:var(--ink)}
a{color:var(--blue);text-decoration:none}a:hover{color:#1E40AF}
.page{padding:24px;display:flex;flex-direction:column;gap:28px;min-height:100vh}
.hero{background:var(--soft);border:1px solid #D5E3FB;border-radius:20px;padding:20px 28px 36px;display:flex;flex-direction:column;gap:36px}
.nav{display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:12px 24px;background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(15,23,42,.04)}
.logo{display:flex;align-items:center}
.logo img{height:34px;width:auto;display:block}
.menu{display:flex;gap:36px;flex-wrap:wrap;font-size:14px;font-weight:600}
.menu a{color:#94A3B8}.menu a:hover,.menu a.active{color:var(--ink)}
.user{height:40px;padding:0 24px;border:0;border-radius:10px;background:#F59E0B;color:#fff;font:600 14px 'Poppins',sans-serif;cursor:pointer}
.hero-text{display:flex;flex-direction:column;gap:12px;padding:0 12px}
h1{margin:0;font-size:44px;line-height:1.15;font-weight:800}
h1 span{color:var(--blue)}
.hero-text p{margin:0;color:var(--muted);font-size:15px;max-width:600px;line-height:1.5}
.layout{display:flex;gap:28px;flex-wrap:wrap;align-items:flex-start;width:100%}
.card{background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 2px 10px rgba(15,23,42,.06)}
form{flex:2 1 560px;min-width:0;padding:32px;display:flex;flex-direction:column;gap:24px}
aside{flex:1 1 280px;min-width:0;display:flex;flex-direction:column;gap:20px}
.field{display:flex;flex-direction:column;gap:8px}
.row{display:flex;gap:20px;flex-wrap:wrap}.row .field{flex:1 1 240px}
label,.lbl{font-weight:600;font-size:14px}
input[type=text],input[type=date],select,textarea{width:100%;border:1px solid #CBD5E1;border-radius:10px;padding:0 14px;font:400 14px 'Poppins',sans-serif;background:#fff;color:var(--ink)}
input[type=text],input[type=date],select{height:48px}
textarea{padding:12px 14px;resize:vertical}
input:focus,select:focus,textarea:focus,button:focus-visible{outline:2px solid var(--blue);outline-offset:2px}
.drop{position:relative;border:2px dashed #93B4F0;border-radius:12px;background:#F3F7FF;min-height:200px;display:flex;align-items:center;justify-content:center;text-align:center;overflow:hidden}
.drop.drag{background:#E0EBFF;border-color:var(--blue)}
.drop-empty{display:flex;flex-direction:column;align-items:center;gap:8px;padding:32px 16px}
.drop-empty small{color:var(--muted);font-size:13px}
.pick{margin-top:4px;height:40px;padding:0 18px;border:1px solid var(--blue);background:#fff;color:var(--blue);border-radius:10px;font:600 14px 'Poppins',sans-serif;cursor:pointer}
.drop img{display:none;width:100%;max-height:320px;object-fit:contain;background:#fff}
.drop.has img{display:block}.drop.has .drop-empty{display:none}
.remove{display:none;position:absolute;top:10px;right:10px;height:36px;padding:0 14px;border:0;border-radius:8px;background:rgba(15,23,42,.82);color:#fff;font:600 13px 'Poppins',sans-serif;cursor:pointer}
.drop.has .remove{display:block}
.err{color:#B91C1C;font-size:13px;min-height:16px}
.actions{display:flex;justify-content:flex-end;gap:12px;flex-wrap:wrap;padding-top:20px;border-top:1px solid var(--line)}
.btn{height:48px;padding:0 30px;border-radius:10px;font:600 14px 'Poppins',sans-serif;cursor:pointer}
.btn.ghost{border:1px solid var(--blue);background:#fff;color:var(--blue)}
.btn.main{border:0;background:var(--blue);color:#fff}.btn.main:hover{background:#1D4ED8}
.pv{padding:20px;display:flex;flex-direction:column;gap:14px}
.pv h2,.tips h2{margin:0;font-size:16px;font-weight:700}
.item{border:1px solid var(--line);border-radius:12px;padding:10px;display:flex;flex-direction:column;gap:10px}
.thumb{height:140px;border-radius:8px;background:#E2E8F0;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:13px;overflow:hidden}
.thumb img{width:100%;height:100%;object-fit:cover;display:none}
.thumb.has img{display:block}.thumb.has span{display:none}
.tags{display:flex;gap:6px;flex-wrap:wrap}
.badge{background:#DDF5F0;color:#0F766E;font-size:11px;font-weight:600;padding:4px 10px;border-radius:999px}
.badge.cat{background:#EEF2FF;color:#3730A3}
.name{font-weight:700;font-size:15px;overflow-wrap:anywhere}
.meta{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);overflow-wrap:anywhere}
.tips{background:#F3F7FF;border:1px solid #D5E3FB;border-radius:16px;padding:20px;display:flex;flex-direction:column;gap:10px}
.tips h2{color:#1E3A8A}
.tips ul{margin:0;padding-left:18px;display:flex;flex-direction:column;gap:8px;font-size:13px;color:#334155;line-height:1.5}
footer{border-top:1px solid var(--line);padding-top:16px;display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;font-size:12px;color:var(--muted)}
@media(max-width:640px){h1{font-size:30px}.menu{gap:18px}form{padding:20px}}
.fe{display:flex;align-items:center;gap:6px;color:#B91C1C;font-size:13px;font-weight:500}
.fe[hidden]{display:none}
.invalid{border:1.5px solid #B91C1C!important}
.drop.invalid{border:2px dashed #B91C1C!important;background:#FEF2F2}
.banner{display:flex;gap:12px;align-items:flex-start;background:#FEF2F2;border:1px solid #FCA5A5;border-radius:12px;padding:14px 16px;color:#7F1D1D}
.banner strong{display:block;font-size:15px}.banner span{font-size:14px}
</style>
</head>
<body>
<div class="page">

<div class="hero">
<header class="nav">
<a href="{{ route('dashboard') }}" class="logo">
<img src="{{ asset('img/FindU.png') }}" alt="FindU">
</a>
<nav class="menu"><a href="{{ route('dashboard') }}">Beranda</a><a href="#">Cari</a><a href="#">Riwayat</a><a href="#">Tentang Kami</a></nav>
<button type="button" class="user">{{ Auth::user()->name ?? 'Nadia' }}</button>
</header>
<div class="hero-text">
<a href="{{ route('dashboard') }}" style="font-size:14px;font-weight:500">← Kembali ke Beranda</a>
<h1>Laporkan Barang <span>Ditemukan</span></h1>
<p>Bantu sesama mengembalikan barang yang bukan milikmu. Isi detail barang selengkap mungkin agar pemiliknya mudah mengenali.</p>
</div>
</div>

<div class="layout">

<form id="form" class="card" method="post" action="{{ route('barang.ditemukan.store') }}" enctype="multipart/form-data" novalidate>
@csrf

@if($errors->any())
<div class="banner" role="alert">
<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.2" aria-hidden="true" style="flex:none;margin-top:1px"><path d="M12 3l10 18H2L12 3z"/><path d="M12 10v5M12 18v.5"/></svg>
<div><strong>Laporan belum bisa dikirim</strong><span>{{ $errors->count() }} kolom masih perlu dilengkapi: {{ implode(', ',$errors->keys()) }}.</span></div>
</div>
@endif

<div class="field">
<span class="lbl" id="fotoLbl">Foto Barang</span>
<div class="drop{{ $errors->has('foto') ? ' invalid' : '' }}" id="drop">
<div class="drop-empty">
<svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2"/><path d="M21 16l-5-5-8 8"/></svg>
<strong>Unggah foto barang</strong>
<small>JPG atau PNG, maksimal 5 MB</small>
<input type="file" id="foto" name="foto" accept="image/png,image/jpeg" aria-labelledby="fotoLbl" style="font-size:13px;margin-top:4px;max-width:100%">
</div>
<img id="img" alt="Pratinjau foto yang dipilih">
<button type="button" class="remove" id="remove">Hapus foto</button>
</div>
@error('foto')
<div class="fe" id="e-foto"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>{{ $message }}</div>
@enderror
<div class="err" id="fotoErr" role="alert"></div>
</div>

<div class="field">
<label for="nama">Nama Barang</label>
<input id="nama" name="nama" type="text" maxlength="60" class="{{ $errors->has('nama') ? 'invalid' : '' }}" value="{{ old('nama') }}" placeholder="Contoh: Dompet kulit warna cokelat">
@error('nama')
<div class="fe" id="e-nama"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>{{ $message }}</div>
@enderror
</div>

<div class="row">
<div class="field">
<label for="kategori">Kategori</label>
<select id="kategori" name="kategori" class="{{ $errors->has('kategori') ? 'invalid' : '' }}">
<option value="">Pilih kategori</option>
@foreach($daftarKategori as $k)
<option value="{{ $k }}"{{ old('kategori') === $k ? ' selected' : '' }}>{{ $k }}</option>
@endforeach
</select>
@error('kategori')
<div class="fe" id="e-kategori"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>{{ $message }}</div>
@enderror
</div>
<div class="field">
<label for="tanggal">Tanggal Ditemukan</label>
<input id="tanggal" name="tanggal" type="date" max="{{ date('Y-m-d') }}" class="{{ $errors->has('tanggal') ? 'invalid' : '' }}" value="{{ old('tanggal') }}">
@error('tanggal')
<div class="fe" id="e-tanggal"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>{{ $message }}</div>
@enderror
</div>
</div>

<div class="field">
<label for="lokasi">Lokasi Ditemukan</label>
<input id="lokasi" name="lokasi" type="text" maxlength="80" class="{{ $errors->has('lokasi') ? 'invalid' : '' }}" value="{{ old('lokasi') }}" placeholder="Contoh: Perpustakaan UB, lantai 2 dekat meja baca">
@error('lokasi')
<div class="fe" id="e-lokasi"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>{{ $message }}</div>
@enderror
</div>

<div class="field">
<label for="deskripsi">Deskripsi Barang</label>
<textarea id="deskripsi" name="deskripsi" rows="4" maxlength="500" class="{{ $errors->has('deskripsi') ? 'invalid' : '' }}" placeholder="Ciri-ciri barang: warna, merek, kondisi. Jangan tulis detail yang hanya diketahui pemilik asli.">{{ old('deskripsi') }}</textarea>
@error('deskripsi')
<div class="fe" id="e-deskripsi"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B91C1C" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16.5v.5"/></svg>{{ $message }}</div>
@enderror
</div>

<div class="actions">
<a class="btn ghost" href="{{ route('barang.ditemukan.create') }}" style="display:inline-flex;align-items:center">Batal</a>
<button type="submit" class="btn main">Kirim Laporan</button>
</div>
</form>

<aside>
<div class="card pv">
<h2>Tampilan di Barang Terbaru</h2>
<div class="item">
<div class="thumb" id="thumb"><span>Foto barang</span><img id="pvImg" alt=""></div>
<div class="tags"><span class="badge">Ditemukan</span><span class="badge cat" id="pvKat" hidden></span></div>
<div class="name" id="pvNama">Nama barang</div>
<div class="meta">
<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><path d="M12 22s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg>
<span id="pvLokasi">Lokasi ditemukan</span></div>
<div class="meta">
<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
<span id="pvTanggal">Baru saja</span></div>
</div>
</div>
<div class="tips">
<h2>Tips melapor</h2>
<ul>
<li>Foto dari beberapa sisi agar mudah dikenali.</li>
<li>Tulis lokasi sespesifik mungkin.</li>
<li>Tutup info pribadi (nomor kartu, NIM) pada foto.</li>
<li>Simpan barang dengan aman sampai ada yang mengklaim.</li>
</ul>
</div>
</aside>

</div>

</div>

<script>
const $ = id => document.getElementById(id);
let fotoUrl = null;

function tampilkanFoto(file){
  $('fotoErr').textContent = '';
  if (fotoUrl) URL.revokeObjectURL(fotoUrl);
  fotoUrl = URL.createObjectURL(file);
  $('img').src = fotoUrl;
  $('pvImg').src = fotoUrl;
  $('drop').classList.add('has');
  $('drop').classList.remove('invalid');$('thumb').classList.add('has');
  const e = $('e-foto'); if (e) e.hidden = true;
}
function hapusFoto(){
  if (fotoUrl) URL.revokeObjectURL(fotoUrl);
  fotoUrl = null;
  $('foto').value = '';
  $('img').removeAttribute('src');$('pvImg').removeAttribute('src');
  $('drop').classList.remove('has');$('thumb').classList.remove('has');
}
function cekFoto(file){
  if (!file) return;
  if (!/^image\/(png|jpeg)$/.test(file.type)) {$('fotoErr').textContent = 'File harus berformat JPG atau PNG.'; hapusFoto(); return; }
  if (file.size > 5 * 1024 * 1024) { $('fotoErr').textContent = 'Ukuran foto maksimal 5 MB.'; hapusFoto(); return; }
  tampilkanFoto(file);
}
$('foto').addEventListener('change', e => cekFoto(e.target.files[0]));$('remove').addEventListener('click', hapusFoto);
['dragenter','dragover'].forEach(t => $('drop').addEventListener(t, e => { e.preventDefault();$('drop').classList.add('drag'); }));
['dragleave','drop'].forEach(t => $('drop').addEventListener(t, e => { e.preventDefault(); $('drop').classList.remove('drag'); }));$('drop').addEventListener('drop', e => {
  const file = e.dataTransfer.files[0];
  if (file) { try { $('foto').files = e.dataTransfer.files; } catch (err) {} cekFoto(file); }
});

function formatTanggal(t){
  return new Date(t + 'T00:00:00').toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'});
}
function updateText(){
  $('pvNama').textContent =$('nama').value.trim() || 'Nama barang';
  $('pvLokasi').textContent =$('lokasi').value.trim() || 'Lokasi ditemukan';
  const k = $('kategori').value;
  $('pvKat').textContent = k; $('pvKat').hidden = !k;
  const t = $('tanggal').value;
  $('pvTanggal').textContent = t ? formatTanggal(t) : 'Baru saja';
}
['nama','lokasi','kategori','tanggal'].forEach(id => $(id).addEventListener('input', () => {
  updateText();
  $(id).classList.remove('invalid');
  const e = $('e-' + id); if (e) e.hidden = true;
}));
updateText();
</script>
</body>
</html>
