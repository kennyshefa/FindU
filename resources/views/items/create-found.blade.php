@extends('layouts.app')

@section('title', 'Laporkan Barang Ditemukan')

@section('content')
<div class="space-y-6">

    <!-- Tombol Kembali -->
    <div>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-blue-600 hover:underline">
            <span>&larr;</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Header Judul Sesuai UPLOAD BARANG DITEMUKAN.png -->
    <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
            Laporkan Barang <span class="text-blue-600">Ditemukan</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 max-w-2xl leading-relaxed">
            Bantu sesama mengembalikan barang yang bukan milikmu. Isi detail barang selengkap mungkin agar pemiliknya mudah mengenali.
        </p>
    </div>

    <!-- Layout 2 Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- Kolom Kiri: Form Input (2 Kolom) -->
        <div class="lg:col-span-2">
            <form action="{{ route('items.store-found') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-5">
                @csrf

                @if ($errors->any())
                    <div class="bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl p-4 text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Unggah Foto Barang -->
                <div class="border-2 border-dashed border-blue-200 bg-blue-50/30 rounded-2xl p-6 text-center space-y-2 hover:bg-blue-50/50 transition cursor-pointer">
                    <div class="w-10 h-10 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-xs font-bold text-slate-800">Unggah foto barang</div>
                    <p class="text-[11px] text-slate-400">JPG atau PNG, maksimal 5 MB</p>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png" class="text-xs text-slate-500 pt-1">
                </div>

                <!-- Nama Barang -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-800">Nama Barang <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Dompet kulit warna cokelat" 
                           class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
                </div>

                <!-- Kategori & Tanggal Ditemukan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-800">Kategori</label>
                        <select name="category" class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
                            <option value="">Pilih Kategori</option>
                            <option value="alat_tulis" @selected(old('category') === 'alat_tulis')>Alat Tulis & Pribadi</option>
                            <option value="elektronik" @selected(old('category') === 'elektronik')>Elektronik & Gadget</option>
                            <option value="kendaraan" @selected(old('category') === 'kendaraan')>Aksesoris & Kunci</option>
                            <option value="pakaian" @selected(old('category') === 'pakaian')>Pakaian & Perlengkapan</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-800">Tanggal Ditemukan</label>
                        <input type="date" name="found_date" value="{{ old('found_date', date('Y-m-d')) }}"
                               class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
                    </div>
                </div>

                <!-- Lokasi Ditemukan -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-800">Lokasi Ditemukan <span class="text-rose-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location') }}" required placeholder="Contoh: Perpustakaan UB, lantai 2 dekat meja baca" 
                           class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
                </div>

                <!-- Deskripsi Barang -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-800">Deskripsi Barang</label>
                    <textarea name="description" rows="3" placeholder="Ciri-ciri barang: warna, merek, kondisi. Jangan tulis detail yang hanya diketahui pemilik asli." 
                              class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">{{ old('description') }}</textarea>
                </div>

                <!-- Tombol Aksi Form -->
                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                    <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold px-6 py-2.5 rounded-xl transition shadow-xs">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>

        <!-- Kolom Kanan: Preview & Tips (1 Kolom) -->
        <div class="space-y-6">

            <!-- Card: Tampilan di Barang Terbaru -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-3">
                <h3 class="text-xs font-bold text-slate-800">Tampilan di Barang Terbaru</h3>

                <div class="border border-slate-100 rounded-2xl p-3.5 space-y-2.5 bg-slate-50/50">
                    <div class="h-32 rounded-xl bg-slate-200 flex items-center justify-center text-xs font-semibold text-slate-400">
                        Foto barang
                    </div>
                    <div class="space-y-1">
                        <span class="inline-block bg-emerald-50 text-emerald-600 border border-emerald-200/80 text-[10px] font-bold px-2 py-0.5 rounded">
                            Ditemukan
                        </span>
                        <div class="text-xs font-bold text-slate-800">Nama barang</div>
                        <div class="text-[11px] text-slate-400">📍 Lokasi ditemukan</div>
                        <div class="text-[11px] text-slate-400">🕒 Baru Saja</div>
                    </div>
                </div>
            </div>

            <!-- Card: Tips Melapor -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 space-y-3">
                <h3 class="text-xs font-bold text-slate-800">Tips melapor</h3>
                <ul class="space-y-2 text-xs text-slate-500 leading-relaxed list-disc list-inside">
                    <li>Foto dari beberapa sisi agar mudah dikenali.</li>
                    <li>Tulis lokasi sespesifik mungkin.</li>
                    <li>Tutup info pribadi (nomor kartu, NIM) pada foto.</li>
                    <li>Simpan barang yang aman sampai ada yang mengklaim.</li>
                </ul>
            </div>

        </div>

    </div>

</div>
@endsection