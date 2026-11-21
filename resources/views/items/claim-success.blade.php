@extends('layouts.app')

@section('title', 'Klaim Berhasil')

@section('content')
<div class="max-w-xl mx-auto py-6">

    <!-- Card Putih Utama Sesuai Figma BERHASIL KLAIM.png -->
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-100">

        <!-- Icon Centang Hijau Mint -->
        <div class="text-center">
            <div class="w-12 h-12 mx-auto rounded-full bg-[#D1FAE5] text-[#10B981] flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Klaim <span class="text-blue-600">Berhasil</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1.5 font-medium">
                Barang diserahkan setelah verifikasi petugas dan tercatat di riwayatmu.
            </p>
        </div>

        <!-- Stepper 4 Milestone: Bar Biru di Atas, Label di Bawah Sesuai Figma -->
        <div class="mt-6 pt-2 pb-4 border-b border-slate-100">
            <div class="grid grid-cols-4 gap-2 mb-2">
                <div class="h-1 bg-blue-600 rounded-full"></div>
                <div class="h-1 bg-blue-600 rounded-full"></div>
                <div class="h-1 bg-blue-600 rounded-full"></div>
                <div class="h-1 bg-blue-600 rounded-full"></div>
            </div>
            <div class="grid grid-cols-4 gap-2 text-center text-[11px] font-medium text-slate-600">
                <div>Dikonfirmasi</div>
                <div>Ke pos satpam</div>
                <div>Verifikasi</div>
                <div>Diserahkan</div>
            </div>
        </div>

        <!-- Detail Barang: Thumbnail Kiri, Info Kanan (Tanpa Box Abu-abu Luar) Sesuai Figma -->
        <div class="py-5 border-b border-slate-100 flex items-center gap-4">
            <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 shrink-0 shadow-xs">
                <img src="https://images.unsplash.com/photo-1627123424574-724758594e93?w=200&auto=format&fit=crop&q=80" alt="Dompet" class="w-full h-full object-cover">
            </div>
            <div class="space-y-1">
                <div>
                    <span class="inline-block bg-[#D1FAE5] text-[#059669] text-[10px] font-semibold px-2.5 py-0.5 rounded-full">
                        Selesai
                    </span>
                </div>
                <h3 class="text-base font-bold text-slate-900 leading-tight">Dompet</h3>
                <p class="text-xs text-slate-400 font-medium">Kode klaim: FU-2611-0042</p>
            </div>
        </div>

        <!-- Jejak Serah Terima Sesuai Figma -->
        <div class="pt-5 pb-2">
            <h4 class="font-bold text-slate-900 text-sm mb-3">Jejak Serah Terima</h4>
            
            <div class="text-xs">
                <!-- Log 1 -->
                <div class="border-b border-slate-100 pb-3">
                    <div class="font-bold text-slate-900 text-xs">20 Nov 2026, 14.32</div>
                    <div class="text-slate-500 text-xs mt-0.5">Diserahkan oleh [Nama Petugas] setelah 4 poin verifikasi terpenuhi</div>
                </div>

                <!-- Log 2 -->
                <div class="border-b border-slate-100 py-3">
                    <div class="font-bold text-slate-900 text-xs">20 Nov 2026, 14.30</div>
                    <div class="text-slate-500 text-xs mt-0.5">Foto serah terima diambil dan dicatat server</div>
                </div>

                <!-- Log 3 -->
                <div class="pt-3">
                    <div class="font-bold text-slate-900 text-xs">20 Nov 2026, 10.15</div>
                    <div class="text-slate-500 text-xs mt-0.5">Klaim diajukan, kode FU-2611-0042 dibuat</div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi di Bawah Sesuai Figma -->
        <div class="flex items-center justify-center gap-3 pt-6">
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
