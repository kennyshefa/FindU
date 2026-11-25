@extends('layouts.app')

@section('title', 'Cari Barang')

@section('content')
<div class="space-y-6">

    <!-- Search Bar Top Input Sesuai SEARCH.png -->
    <div class="max-w-2xl mx-auto pt-2 pb-1">
        <form action="{{ route('items.search') }}" method="GET" class="relative flex items-center">
            <div class="absolute left-4 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari nama barang, lokasi, atau kategori..." 
                   class="w-full bg-white pl-12 pr-28 py-3.5 rounded-2xl border border-slate-200 text-xs sm:text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 shadow-xs">
            <button type="submit" class="absolute right-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-6 py-2 rounded-xl transition shadow-xs flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span>Cari</span>
            </button>
        </form>
    </div>

    <!-- Header Hasil Pencarian -->
<div class="space-y-1">
    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Hasil Pencarian</h1>
    <p class="text-xs text-slate-400 font-medium">
        Ditemukan {{ $searchResults->count() }} hasil @if($keyword !== '') untuk "{{ $keyword }}" @endif
    </p>
</div>

    <!-- Filter & Sort Bar Sesuai SEARCH.png -->
    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('items.search', ['status' => 'semua', 'q' => $keyword]) }}" 
               class="px-5 py-1.5 rounded-full text-xs font-semibold {{ $filter === 'semua' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }} transition">
                Semua
            </a>
            <a href="{{ route('items.search', ['status' => 'hilang', 'q' => $keyword]) }}" 
               class="px-5 py-1.5 rounded-full text-xs font-semibold {{ $filter === 'hilang' ? 'bg-blue-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }} transition">
                Hilang
            </a>
            <a href="{{ route('items.search', ['status' => 'ditemukan', 'q' => $keyword]) }}" 
               class="px-5 py-1.5 rounded-full text-xs font-semibold {{ $filter === 'ditemukan' ? 'bg-blue-600 text-white shadow-xs' : 'bg-[#F0FDF4] text-[#16A34A] border border-[#BBF7D0] hover:bg-emerald-50' }} transition">
                Ditemukan
            </a>
        </div>

        <div>
            <select class="bg-white border border-slate-200 text-slate-600 text-xs rounded-xl px-3 py-1.5 focus:outline-none shadow-2xs">
                <option>Terbaru</option>
                <option>Terlama</option>
            </select>
        </div>
    </div>

    <!-- Grid Kartu Hasil Pencarian -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    @forelse($searchResults as $item)
    <a href="{{ route('items.show', $item['id']) }}" class="bg-white rounded-3xl p-4 border border-slate-100 shadow-sm hover:border-blue-200 hover:shadow-md transition space-y-3 group block">
        <!-- Foto Barang -->
        <div class="h-44 w-full rounded-2xl bg-[#F8FAFC] overflow-hidden flex items-center justify-center p-1">
            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
        </div>

        <!-- Detail Barang -->
        <div class="space-y-1.5 px-0.5 pb-1">
            <div>
                <span class="inline-block {{ $item['type'] === 'hilang' ? 'bg-amber-50 text-amber-700 border border-amber-200/80' : 'bg-[#E8F8F2] text-[#10B981]' }} text-[10px] font-bold px-2.5 py-0.5 rounded-md">
                    {{ ucfirst($item['type']) }}
                </span>
            </div>
            <h3 class="text-sm font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $item['name'] }}</h3>
            <div class="space-y-0.5 text-[11px] text-slate-400">
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
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
    @empty
    <div class="col-span-full bg-white rounded-3xl p-8 text-center text-xs sm:text-sm text-slate-400 border border-slate-100">
        Tidak ada barang yang cocok dengan pencarianmu.
    </div>
    @endforelse
</div>

</div>
@endsection
