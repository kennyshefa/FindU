@extends('layouts.app')

@section('title', 'Klaim Berhasil')

@section('content')
<div class="max-w-xl mx-auto py-6">

    <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-100 space-y-6">

        <!-- Centang Hijau & Judul Sesuai BERHASIL KLAIM.png -->
        <div class="text-center space-y-3">
            <div class="w-14 h-14 mx-auto rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Klaim Berhasil</h1>
                <p class="text-xs text-slate-500 mt-1">
                    Barang diserahkan setelah verifikasi petugas dan tercatat di riwayatmu.
                </p>
            </div>
        </div>

        <!-- Stepper 4 Milestone Lengkap -->
        <div class="pt-2">
            <div class="grid grid-cols-4 gap-2 text-center text-xs font-medium text-slate-500">
                <div>
                    <span class="mb-1.5 block text-slate-800 font-semibold text-[11px]">Dikonfirmasi</span>
                    <div class="w-full h-1 bg-blue-600 rounded-full"></div>
                </div>
                <div>
                    <span class="mb-1.5 block text-slate-800 font-semibold text-[11px]">Ke pos satpam</span>
                    <div class="w-full h-1 bg-blue-600 rounded-full"></div>
                </div>
                <div>
                    <span class="mb-1.5 block text-slate-800 font-semibold text-[11px]">Verifikasi</span>
                    <div class="w-full h-1 bg-blue-600 rounded-full"></div>
                </div>
                <div>
                    <span class="mb-1.5 block text-slate-800 font-semibold text-[11px]">Diserahkan</span>
                    <div class="w-full h-1 bg-blue-600 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Kartu Barang yang Diklaim -->
        <div class="border border-slate-100 rounded-2xl p-4 bg-slate-50/60 flex items-center gap-4">
            <div class="w-16 h-16 rounded-xl bg-slate-200 shrink-0 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1627123424574-724758594e93?w=200&auto=format&fit=crop&q=80" alt="Dompet" class="w-full h-full object-cover">
            </div>
            <div class="space-y-1">
                <span class="inline-block bg-emerald-50 text-emerald-600 border border-emerald-200 text-[10px] font-bold px-2 py-0.5 rounded">
                    Selesai
                </span>
                <div class="text-sm font-bold text-slate-900">Dompet</div>
                <div class="text-xs text-slate-400">Kode klaim: FU-2611-0042</div>
            </div>
        </div>

        <!-- Jejak Serah Terima -->
        <div class="space-y-3 pt-2 text-xs">
            <h3 class="font-bold text-slate-900 text-sm">Jejak Serah Terima</h3>
            
            <div class="space-y-2.5 text-slate-600 divide-y divide-slate-100">
                <div class="pt-2">
                    <div class="font-bold text-slate-800">20 Nov 2026, 14.32</div>
                    <div class="text-slate-500">Diserahkan oleh [Nama Petugas] setelah 4 poin verifikasi terpenuhi</div>
                </div>
                <div class="pt-2">
                    <div class="font-bold text-slate-800">20 Nov 2026, 14.30</div>
                    <div class="text-slate-500">Foto serah terima diambil dan dicatat server</div>
                </div>
                <div class="pt-2">
                    <div class="font-bold text-slate-800">20 Nov 2026, 10.15</div>
                    <div class="text-slate-500">Klaim diajukan, kode FU-2611-0042 dibuat</div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-center gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-xl transition shadow-xs">
                Kembali ke Dashboard
            </a>
            <a href="{{ route('claims.index') }}" class="border border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-xl transition">
                Lihat Riwayat Klaim
            </a>
        </div>

    </div>

</div>
@endsection
