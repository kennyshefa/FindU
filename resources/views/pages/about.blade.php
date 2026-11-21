@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('container-class', 'max-w-5xl mx-auto px-4 sm:px-6 py-8')

@section('content')
<div class="space-y-10">

    <!-- 1. Hero Section -->
    <div class="space-y-2">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
            Yuk Kenali <span class="text-blue-600">FindU</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 max-w-2xl leading-relaxed">
            Website Lost & Found untuk membantu mahasiswa melaporkan, mencari, dan menemukan kembali barang yang hilang maupun ditemukan di lingkungan kampus.
        </p>
    </div>

    <!-- 2. Ringkasan Metrik (4 Kartu) -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
        @foreach($stats as $stat)
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100 text-left">
            <div class="text-2xl sm:text-3xl font-black text-blue-600">{{ $stat['count'] }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>

    <!-- 3. Section: Kenapa FindU ada? -->
    <div class="space-y-3">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Kenapa <span class="text-blue-600">FindU</span> ada?</h2>
            <p class="text-xs text-slate-500">Dari informasi yang tercecer menjadi satu sistem yang rapi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Masalah -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 space-y-2.5">
                <span class="inline-block bg-rose-50 text-rose-600 border border-rose-200 text-[11px] font-bold px-2.5 py-0.5 rounded-md">
                    Masalah
                </span>
                <h3 class="text-sm font-bold text-slate-900">Informasi mudah tertumpuk</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Barang yang tertinggal sulit dikembalikan karena pencarian hanya lewat bertanya ke orang lain atau grup chat, yang pesannya cepat tenggelam.
                </p>
            </div>

            <!-- Solusi -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 space-y-2.5">
                <span class="inline-block bg-emerald-50 text-emerald-600 border border-emerald-200 text-[11px] font-bold px-2.5 py-0.5 rounded-md">
                    Solusi
                </span>
                <h3 class="text-sm font-bold text-slate-900">Satu media terpusat</h3>
                <p class="text-xs text-slate-500 leading-relaxed">
                    FindU mengumpulkan laporan barang hilang dan ditemukan dalam satu website agar lebih mudah dicari, dipantau, dan dikembalikan ke pemiliknya.
                </p>
            </div>
        </div>
    </div>

    <!-- 4. Section: Apa yang bisa kamu lakukan -->
    <div class="space-y-3">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Apa yang bisa kamu <span class="text-blue-600">lakukan</span></h2>
            <p class="text-xs text-slate-500">Fitur yang tersedia di FindU</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            @foreach($features as $f)
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 space-y-2 hover:border-blue-200 transition">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                    @if($f['icon'] == 'key')
                        🔑
                    @elseif($f['icon'] == 'layout')
                        📊
                    @elseif($f['icon'] == 'user')
                        👤
                    @elseif($f['icon'] == 'megaphone')
                        📢
                    @elseif($f['icon'] == 'package')
                        📦
                    @elseif($f['icon'] == 'search')
                        🔍
                    @elseif($f['icon'] == 'check-circle')
                        🛡️
                    @elseif($f['icon'] == 'tag')
                        🏷️
                    @elseif($f['icon'] == 'bell')
                        🔔
                    @endif
                </div>
                <h3 class="text-xs sm:text-sm font-bold text-slate-900">{{ $f['title'] }}</h3>
                <p class="text-[11px] sm:text-xs text-slate-500 leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 5. Section: Cara kerjanya -->
    <div class="space-y-3">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Cara <span class="text-blue-600">kerjanya</span></h2>
            <p class="text-xs text-slate-500">Dari melapor sampai barang kembali.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            @foreach($steps as $s)
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 space-y-2">
                <div class="w-7 h-7 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center">
                    {{ $s['step'] }}
                </div>
                <h3 class="text-xs sm:text-sm font-bold text-slate-900">{{ $s['title'] }}</h3>
                <p class="text-[11px] sm:text-xs text-slate-500 leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Status Legend Bar -->
        <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px] text-slate-500">
            <span class="font-semibold text-slate-700">Status barang:</span>
            <span class="bg-amber-100 text-amber-700 px-2.5 py-0.5 rounded-md font-medium">Menunggu</span>
            <span class="bg-blue-100 text-blue-700 px-2.5 py-0.5 rounded-md font-medium">Diproses</span>
            <span class="bg-emerald-100 text-emerald-700 px-2.5 py-0.5 rounded-md font-medium">Ditemukan</span>
            <span class="bg-cyan-100 text-cyan-700 px-2.5 py-0.5 rounded-md font-medium">Ditolak</span>
            <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 px-2.5 py-0.5 rounded-md font-medium">Selesai</span>
        </div>
    </div>

    <!-- 6. Section: Tim Pengembang -->
    <div class="space-y-3">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Tim <span class="text-blue-600">Pengembang</span></h2>
            <p class="text-xs text-slate-500">Mahasiswa Pendidikan Teknologi Informasi, Fakultas Ilmu Komputer, Universitas Brawijaya.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            @foreach($team as $m)
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-full {{ $m['bg_color'] }} text-white font-black text-xs flex items-center justify-center tracking-wider shadow-sm">
                        {{ $m['initials'] }}
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900">{{ $m['name'] }}</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $m['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-[11px] text-slate-400 pt-1">
            Dosen pengampu: <span class="font-medium text-slate-600">X. Wibisono Sukmo Wardhono, S.T., M.T.</span> &middot; Asisten: <span class="font-medium text-slate-600">Yesstina Agustine K. G. & Raisa Kholila K.</span>
        </div>
    </div>

    <!-- 7. Section: Dibangun dengan -->
    <div class="space-y-3">
        <h2 class="text-base sm:text-lg font-bold text-slate-900">Dibangun <span class="text-blue-600">dengan</span></h2>
        <div class="flex flex-wrap gap-2">
            @foreach($techStack as $tech)
            <span class="bg-white border border-slate-200 text-slate-700 text-xs font-semibold px-4 py-1.5 rounded-full shadow-2xs">
                {{ $tech }}
            </span>
            @endforeach
        </div>
    </div>

    <!-- 8. Section: Batasan Layanan -->
    <div class="space-y-3">
        <h2 class="text-base sm:text-lg font-bold text-slate-900">Batasan <span class="text-blue-600">layanan</span></h2>
        <div class="bg-amber-50/90 border border-amber-200/70 rounded-2xl p-4 text-xs text-amber-900/90 leading-relaxed">
            FindU tidak mencakup pelacakan lokasi barang lewat GPS, layanan pengiriman barang, atau integrasi otomatis dengan sistem keamanan kampus. Verifikasi kepemilikan dan penyerahan barang tetap memerlukan konfirmasi.
        </div>
    </div>

    <!-- 9. CTA Box -->
    <div class="bg-blue-600 rounded-3xl p-8 sm:p-10 text-center text-white space-y-4 shadow-sm">
        <h2 class="text-xl sm:text-2xl font-black">Kehilangan atau menemukan sesuatu?</h2>
        <p class="text-xs sm:text-sm text-blue-100 max-w-md mx-auto">
            Lapor sekarang dan bantu barang kembali ke pemiliknya.
        </p>
        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <a href="#" class="bg-white hover:bg-slate-50 text-slate-900 text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow">
                Laporkan Barang Hilang
            </a>
            <a href="#" class="bg-amber-500 hover:bg-amber-600 text-white text-xs sm:text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow">
                Laporkan Barang Ditemukan
            </a>
        </div>
    </div>

</div>
@endsection
