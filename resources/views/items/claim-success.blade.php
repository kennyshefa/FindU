@extends('layouts.app')

@section('title', 'Klaim Berhasil')

@section('content')
<div class="max-w-[640px] w-full mx-auto py-4">

    <!-- Card Putih Utama Sesuai Figma BERHASIL KLAIM.png (1440 x 1024) -->
    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100">

        <!-- Icon Centang Hijau Sesuai Desain Figma -->
        <div class="text-center">
            <div class="w-14 h-14 mx-auto mb-5 flex items-center justify-center">
                <img src="{{ asset('images/check_circle_clean.png') }}" class="w-14 h-14 object-contain rounded-full shadow-2xs" alt="Centang Selesai">
            </div>
            <h1 class="text-3xl font-extrabold text-[#111827] tracking-tight">
                Klaim <span class="text-[#2563EB]">Berhasil</span>
            </h1>
            <p class="text-xs sm:text-sm text-[#4B5563] mt-2 font-medium">
                Barang diserahkan setelah verifikasi petugas dan tercatat di riwayatmu.
            </p>
        </div>

        <!-- Stepper 4 Milestone Sesuai Figma: 4 Garis Biru di Atas, Teks Label di Bawah -->
        <div class="mt-8 mb-6 pb-6 border-b border-slate-100">
            <div class="grid grid-cols-4 gap-2.5 mb-2.5">
                <div class="h-1.5 bg-[#2563EB] rounded-full"></div>
                <div class="h-1.5 bg-[#2563EB] rounded-full"></div>
                <div class="h-1.5 bg-[#2563EB] rounded-full"></div>
                <div class="h-1.5 bg-[#2563EB] rounded-full"></div>
            </div>
            <div class="grid grid-cols-4 gap-2.5 text-center text-xs font-normal text-[#4B5563]">
                <div>Dikonfirmasi</div>
                <div>Ke pos satpam</div>
                <div>Verifikasi</div>
                <div>Diserahkan</div>
            </div>
        </div>

        <!-- Detail Barang: Foto Dompet Asli dari Figma, Badge Selesai Hijau Mint, Nama, Kode Klaim -->
        <div class="flex items-center gap-5 py-6 border-b border-slate-100">
            <div class="w-28 h-28 rounded-2xl overflow-hidden shrink-0 shadow-xs bg-slate-50">
                <img src="{{ asset('images/dompet_klaim.png') }}" alt="Dompet" class="w-full h-full object-cover">
            </div>
            <div class="space-y-1">
                <div>
                    <span class="inline-block bg-[#D1FAE5] text-[#059669] text-xs font-semibold px-3 py-0.5 rounded-full">
                        Selesai
                    </span>
                </div>
                <h3 class="text-lg font-bold text-[#111827] leading-tight">Dompet</h3>
                <p class="text-xs text-[#6B7280] font-medium">Kode klaim: FU-2611-0042</p>
            </div>
        </div>

        <!-- Jejak Serah Terima Sesuai Figma -->
        <div class="pt-6 pb-2">
            <h4 class="font-bold text-[#111827] text-sm mb-3">Jejak Serah Terima</h4>
            
            <div class="text-xs">
                <!-- Log 1 -->
                <div class="border-b border-slate-100 pb-3">
                    <div class="font-bold text-[#111827] text-xs">20 Nov 2026, 14.32</div>
                    <div class="text-[#6B7280] text-xs mt-0.5 font-normal">Diserahkan oleh [Nama Petugas] setelah 4 poin verifikasi terpenuhi</div>
                </div>

                <!-- Log 2 -->
                <div class="border-b border-slate-100 py-3">
                    <div class="font-bold text-[#111827] text-xs">20 Nov 2026, 14.30</div>
                    <div class="text-[#6B7280] text-xs mt-0.5 font-normal">Foto serah terima diambil dan dicatat server</div>
                </div>

                <!-- Log 3 -->
                <div class="pt-3">
                    <div class="font-bold text-[#111827] text-xs">20 Nov 2026, 10.15</div>
                    <div class="text-[#6B7280] text-xs mt-0.5 font-normal">Klaim diajukan, kode FU-2611-0042 dibuat</div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi di Bawah Sesuai Figma -->
        <div class="flex items-center justify-center gap-4 pt-8">
            <a href="{{ route('home') }}" class="bg-[#2563EB] hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-7 py-3 rounded-xl transition shadow-xs">
                Kembali ke Dashboard
            </a>
            <a href="{{ route('claims.index') }}" class="border border-slate-300 text-slate-700 hover:bg-slate-50 font-semibold text-xs sm:text-sm px-7 py-3 rounded-xl transition">
                Lihat Riwayat Klaim
            </a>
        </div>

    </div>

</div>
@endsection
