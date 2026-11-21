@extends('layouts.app')

@section('title', 'Laporan Berhasil Dikirim')

@section('content')
<div class="max-w-xl mx-auto py-8">

    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 text-center space-y-6">
        <!-- Lingkaran Centang Hijau -->
        <div class="w-16 h-16 mx-auto rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <!-- Teks Berhasil -->
        <div class="space-y-2">
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Laporan berhasil <span class="text-blue-600">dikirim</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto">
                Terima kasih sudah membantu. Laporanmu sudah tersimpan dan tampil di Barang Terbaru. Kami akan memberi tahu kamu lewat Notifikasi saat ada yang mengajukan klaim.
            </p>
        </div>

        <!-- Kartu Ringkasan -->
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60 flex items-center gap-4 text-left">
            <div class="w-16 h-16 rounded-xl bg-slate-200 shrink-0 flex items-center justify-center text-xs font-semibold text-slate-400">
                Foto
            </div>
            <div class="space-y-1">
                <span class="inline-block bg-emerald-50 text-emerald-600 border border-emerald-200 text-[10px] font-bold px-2 py-0.5 rounded">
                    Ditemukan
                </span>
                <div class="text-xs font-bold text-slate-900">Dompet Kulit Coklat</div>
                <div class="text-[11px] text-slate-400">📍 Gedung F · 🕒 Baru saja</div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ route('claims.index') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-xl transition shadow-xs text-center">
                Lihat laporan saya
            </a>
            <a href="{{ route('items.create-found') }}" class="w-full sm:w-auto border border-blue-300 text-blue-600 hover:bg-blue-50 font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-xl transition text-center">
                Laporkan barang lain
            </a>
        </div>

        <div>
            <a href="{{ route('home') }}" class="text-xs font-semibold text-blue-600 hover:underline">
                Kembali ke Beranda
            </a>
        </div>
    </div>

</div>
@endsection
