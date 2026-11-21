@extends('layouts.app')

@section('title', 'Laporkan Barang Hilang')

@section('content')
<div class="space-y-6 max-w-3xl mx-auto">

    <!-- Tombol Kembali -->
    <div>
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs sm:text-sm font-semibold text-blue-600 hover:underline">
            <span>&larr;</span>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Header Sesuai UPLOAD BARANG HILANG.png -->
    <div class="space-y-1">
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
            Laporkan Barang Hilang
        </h1>
        <p class="text-xs sm:text-sm text-slate-500">
            Isi informasi barang yang hilang agar dapat membantu proses pencarian.
        </p>
    </div>

    <!-- Card Form Informasi Barang -->
    <form action="{{ route('items.store-lost') }}" method="POST" class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-100 space-y-6">
        @csrf

        <h2 class="text-base font-bold text-slate-900">Informasi Barang</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Nama Barang -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-800">Nama Barang</label>
                <input type="text" placeholder="Contoh: Dompet Hitam" 
                       class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>

            <!-- Kategori -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-800">Kategori</label>
                <select class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
                    <option value="">Pilih kategori</option>
                    <option value="alat_tulis">Alat Tulis</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="kendaraan">Aksesoris</option>
                </select>
            </div>

            <!-- Lokasi Barang -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-800">Lokasi Barang</label>
                <input type="text" placeholder="Contoh: Gedung F" 
                       class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>

            <!-- Tanggal Kehilangan -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-800">Tanggal Kehilangan</label>
                <input type="text" placeholder="Contoh: 27 Oktober 2026" 
                       class="w-full bg-slate-50/60 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:bg-white transition">
            </div>
        </div>

        <!-- Foto Barang Upload Box -->
        <div class="space-y-1.5">
            <label class="text-xs font-bold text-slate-800">Foto Barang</label>
            <div class="border-2 border-dashed border-blue-200 bg-blue-50/30 rounded-2xl p-6 text-center space-y-2 hover:bg-blue-50/50 transition cursor-pointer">
                <div class="w-10 h-10 mx-auto rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </div>
                <div class="text-xs font-bold text-blue-600">Upload Kehilangan Barang</div>
                <p class="text-[11px] text-slate-400">PNG, JPG atau JPEG</p>
                <input type="file" class="text-xs text-slate-500 pt-1">
            </div>
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
@endsection
