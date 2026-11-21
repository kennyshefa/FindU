@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="space-y-8">

    <!-- Hero Section Sesuai DASHBOARD.png & DASHBOARD sebelum login.png -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
        <!-- Hero Text & Search Box (2 Kolom) -->
        <div class="lg:col-span-2 bg-gradient-to-br from-blue-50/80 via-white to-blue-50/40 rounded-3xl p-6 sm:p-10 border border-blue-100/60 shadow-sm flex flex-col justify-between space-y-6">
            <div class="space-y-2">
                <span class="text-xs sm:text-sm font-semibold text-blue-600 tracking-wide">
                    @if($isLoggedIn)
                        Selamat datang kembali, Nadia!
                    @else
                        Selamat datang di FindU
                    @endif
                </span>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                    Temukan Barangmu <br><span class="text-blue-600">Kembali</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 max-w-lg leading-relaxed pt-1">
                    Bantu sesama dengan melaporkan barang hilang atau menemukan barang yang bukan milikmu.
                </p>
            </div>

            <!-- Search Form Bar -->
            <form action="{{ route('items.search') }}" method="GET" class="space-y-2">
                <div class="relative flex items-center">
                    <div class="absolute left-4 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="q" placeholder="Cari nama barang, lokasi, atau kategori..." 
                           class="w-full bg-white pl-12 pr-28 py-3.5 rounded-2xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 shadow-xs">
                    <button type="submit" class="absolute right-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-6 py-2.5 rounded-xl transition shadow-xs flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Cari</span>
                    </button>
                </div>
                <div class="text-[11px] text-slate-400 pl-1 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                    </svg>
                    <span>Cari barang hilang & ditemukan di sekitar UB</span>
                </div>
            </form>
        </div>

        <!-- Banner Kanan: Punya Kabar Barang? Sesuai Figma -->
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-100 shadow-sm flex flex-col justify-between space-y-4">
            <!-- Ilustrasi Box -->
            <div class="h-36 bg-blue-50/60 rounded-2xl flex items-center justify-center p-2 overflow-hidden">
                <img src="{{ asset('images/dashboard/illustration.png') }}" alt="Ilustrasi" class="h-full w-full object-contain">
            </div>

            <div class="space-y-1">
                <h3 class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-1.5">
                    <span class="text-blue-600">+</span> Punya kabar barang?
                </h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Buat laporan agar barang lebih cepat kembali ke pemiliknya.
                </p>
            </div>

            @if($isLoggedIn)
            <!-- Tombol Aksi Lapor (Muncul setelah Login sesuai DASHBOARD.png) -->
            <div class="space-y-2 pt-1">
                <a href="{{ route('items.create-lost') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs py-2.5 rounded-xl transition shadow-xs text-center block">
                    Laporkan Barang Hilang
                </a>
                <a href="{{ route('items.create-found') }}" class="w-full bg-white hover:bg-slate-50 border border-blue-300 text-blue-600 font-semibold text-xs py-2.5 rounded-xl transition shadow-2xs text-center block">
                    Laporkan Barang Ditemukan
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Section Barang Terbaru -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-slate-900">Barang Terbaru</h2>
                <p class="text-xs text-slate-400">Mungkin barang yang kamu cari ada di sini.</p>
            </div>
            <a href="{{ route('items.search') }}" class="text-xs font-semibold text-blue-600 hover:underline flex items-center gap-1">
                <span>Lihat Semua</span>
                <span>&rarr;</span>
            </a>
        </div>

        <!-- Filter Pill Tabs -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="{{ route('home', ['status' => 'semua']) }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'semua' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Semua
                </a>
                <a href="{{ route('home', ['status' => 'hilang']) }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'hilang' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Hilang
                </a>
                <a href="{{ route('home', ['status' => 'ditemukan']) }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'ditemukan' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    Ditemukan
                </a>
            </div>

            <!-- Sort Dropdown -->
            <div>
                <select class="bg-white border border-slate-200 text-slate-600 text-xs rounded-xl px-3 py-1.5 focus:outline-none">
                    <option>Terbaru</option>
                    <option>Terlama</option>
                </select>
            </div>
        </div>

        <!-- Grid 4 Kartu Barang Terbaru Sesuai DASHBOARD.png -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($filteredItems as $item)
            <a href="{{ route('items.show', $item['id']) }}" class="bg-white rounded-3xl p-3.5 border border-slate-100 shadow-sm hover:border-blue-200 hover:shadow-md transition space-y-3 group block">
                <!-- Foto Barang -->
                <div class="h-44 w-full rounded-2xl bg-slate-100 overflow-hidden relative">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>

                <!-- Info Barang -->
                <div class="space-y-1.5 px-1 pb-1">
                    <div>
                        <span class="inline-block {{ $item['type_color'] }} text-[10px] font-bold px-2.5 py-0.5 rounded-md">
                            {{ $item['type_label'] }}
                        </span>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $item['name'] }}</h3>
                    <div class="space-y-0.5 text-[11px] text-slate-400">
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $item['location'] }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $item['time'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
