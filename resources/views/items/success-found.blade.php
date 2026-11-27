@extends('layouts.app')

@section('title', 'Laporan Ditemukan Berhasil')

@section('content')
@php
    $report = $item ?? $foundItem ?? session('found_item') ?? session('reported_item') ?? session('item');

    $rawImage = data_get($report, 'image')
        ?? data_get($report, 'photo')
        ?? data_get($report, 'foto')
        ?? data_get($report, 'image_path');

    $itemName = data_get($report, 'title')
        ?? data_get($report, 'name')
        ?? data_get($report, 'item_name')
        ?? data_get($report, 'nama_barang');

    $itemLocation = data_get($report, 'location')
        ?? data_get($report, 'place')
        ?? data_get($report, 'lokasi')
        ?? '-';

    $rawDate = data_get($report, 'date')
        ?? data_get($report, 'found_at')
        ?? data_get($report, 'tanggal')
        ?? data_get($report, 'created_at');

    if ($rawDate) {
        try {
            $itemDate = \Carbon\Carbon::parse($rawDate)->translatedFormat('d F Y');
        } catch (\Throwable $e) {
            $itemDate = (string)$rawDate;
        }
    } else {
        $itemDate = now()->translatedFormat('d F Y');
    }

    if ($rawImage) {
        if (\Illuminate\Support\Str::startsWith($rawImage, ['http://', 'https://'])) {
            $imageUrl =$rawImage;
        } elseif (\Illuminate\Support\Str::startsWith($rawImage, ['images/', 'storage/'])) {
            $imageUrl = asset(ltrim($rawImage, '/'));
        } else {
            $imageUrl = asset('storage/' . ltrim($rawImage, '/'));
        }
    } else {
        $imageUrl = null;
    }
@endphp

<div class="max-w-xl mx-auto py-8">

    <!-- Card Putih Sesuai LAPORAN BERHASIL.png -->
    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-100 text-center space-y-6">

        <!-- Lingkaran Centang Hijau Mint -->
        <div class="w-16 h-16 mx-auto rounded-full bg-[#D1FAE5] text-[#10B981] flex items-center justify-center shadow-2xs">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <!-- Teks Berhasil -->
        <div class="space-y-2">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Laporan berhasil <span class="text-blue-600">dikirim</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto">
                Terima kasih sudah membantu. Laporanmu sudah tersimpan dan tampil di Barang Terbaru. Kami akan memberi tahu kamu lewat Notifikasi saat ada yang mengajukan klaim.
            </p>
        </div>

        <!-- Kartu Ringkasan Sesuai Figma -->
        <div class="border border-slate-100 rounded-2xl p-4 bg-white flex items-center gap-4 text-left shadow-2xs max-w-sm mx-auto">
            <!-- Foto Barang -->
            <div class="w-16 h-16 rounded-xl bg-slate-100 border border-slate-200/70 overflow-hidden shrink-0 flex items-center justify-center">
                @if ($imageUrl)
                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $itemName ?? 'Barang Ditemukan' }}"
                        class="w-full h-full object-cover"
                    />
                @else
                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                @endif
            </div>

            <!-- Detail Barang -->
            <div class="space-y-1.5 min-w-0 flex-1">
                <div>
                    <span class="inline-block bg-[#D1FAE5] text-[#059669] text-[10px] font-semibold px-2.5 py-0.5 rounded-full">
                        Ditemukan
                    </span>
                </div>

                @if ($itemName)
                    <p class="text-xs sm:text-sm font-bold text-slate-900 truncate">
                        {{ $itemName }}
                    </p>
                @endif

                <div class="flex items-center gap-1.5 text-xs text-slate-600">
                    <svg class="w-3.5 h-3.5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="truncate">{{ $itemLocation }}</span>
                </div>

                <div class="flex items-center gap-1.5 text-xs text-slate-600">
                    <svg class="w-3.5 h-3.5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $itemDate }}</span>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
            <a href="{{ route('claims.index') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-7 py-3 rounded-xl transition shadow-xs text-center">
                Lihat laporan saya
            </a>
            <a href="{{ route('items.create-found') }}" class="w-full sm:w-auto border border-blue-500 text-blue-600 hover:bg-blue-50 font-semibold text-xs sm:text-sm px-6 py-3 rounded-xl transition text-center">
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
