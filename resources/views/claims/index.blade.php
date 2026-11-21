@extends('layouts.app')

@section('title', 'Riwayat Saya')

@section('content')
<div class="space-y-6">

    <!-- Header Halaman Sesuai Desain Revisi -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
            Riwayat <span class="text-blue-600">Saya</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-1">
            Semua aktivitasmu di FindU: barang yang kamu upload, laporan kehilangan, dan klaim.
        </p>
    </div>

    <!-- 4 Kotak Ringkasan Metrik -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
        <!-- 1. Barang diupload -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $stats['uploaded'] }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Barang diupload</div>
        </div>

        <!-- 2. Laporan kehilangan -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $stats['lost'] }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Laporan kehilangan</div>
        </div>

        <!-- 3. Klaim diajukan -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $stats['claimed'] }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Klaim diajukan</div>
        </div>

        <!-- 4. Selesai -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $stats['completed'] }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Selesai</div>
        </div>
    </div>

    <!-- Bagian Klaim Aktif -->
    @if($activeClaim)
    <div class="space-y-3">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Klaim Aktif</h2>
            <p class="text-xs text-slate-500">
                Tunjukkan kode ini ke satpam di {{ $activeClaim->location }} sebelum {{ $activeClaim->expired_date }}.
            </p>
        </div>

        <div class="bg-white rounded-3xl p-5 sm:p-7 shadow-sm border border-slate-100 space-y-6">
            <!-- Header Klaim Aktif (QR, Kode, Info Barang) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-1">
                <div class="flex items-center gap-5">
                    <!-- QR Code Antrean -->
                    <div class="w-24 h-24 bg-white border border-slate-300 rounded-2xl p-2 flex flex-col justify-between shadow-2xs shrink-0">
                        <div class="flex justify-between">
                            <div class="w-6 h-6 border-4 border-slate-800 rounded-sm"></div>
                            <div class="w-2 h-2 bg-slate-800 self-center"></div>
                            <div class="w-6 h-6 border-4 border-slate-800 rounded-sm"></div>
                        </div>
                        <div class="flex justify-center gap-1.5 py-1">
                            <div class="w-2 h-2 bg-slate-800"></div>
                            <div class="w-3 h-2 bg-slate-800"></div>
                            <div class="w-2 h-2 bg-slate-800"></div>
                        </div>
                        <div class="flex justify-between items-end">
                            <div class="w-6 h-6 border-4 border-slate-800 rounded-sm"></div>
                            <div class="w-2 h-2 bg-slate-800"></div>
                            <div class="w-4 h-4 bg-slate-800 rounded-sm"></div>
                        </div>
                    </div>

                    <!-- Kode Klaim & Status -->
                    <div>
                        <div class="text-[11px] font-bold text-slate-400 tracking-wider">KODE KLAIM</div>
                        <div class="text-2xl sm:text-3xl font-black text-blue-600 tracking-tight mt-0.5">
                            {{ $activeClaim->claim_code }}
                        </div>
                        <div class="mt-2">
                            <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200/80 text-xs px-3.5 py-1 rounded-full font-medium">
                                {{ $activeClaim->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info Barang & Foto -->
                <div class="flex items-center gap-4 bg-slate-50/80 p-3 sm:p-4 rounded-2xl border border-slate-100">
                    <div class="w-14 h-14 bg-slate-200 rounded-xl flex items-center justify-center text-xs font-semibold text-slate-400 shrink-0">
                        Foto
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900">{{ $activeClaim->item_name }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Disimpan di {{ $activeClaim->location }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $activeClaim->validity }}</p>
                    </div>
                </div>
            </div>

            <!-- Stepper Progres -->
            <div class="pt-1">
                <div class="grid grid-cols-4 gap-2 text-center text-xs font-medium text-slate-500">
                    <div class="flex flex-col items-center">
                        <span class="text-slate-900 font-bold mb-2">Klaim diajukan</span>
                        <div class="w-full h-1 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mb-2">Ke pos satpam</span>
                        <div class="w-full h-1 bg-slate-200 rounded-full"></div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mb-2">Verifikasi petugas</span>
                        <div class="w-full h-1 bg-slate-200 rounded-full"></div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="mb-2">Diserahkan</span>
                        <div class="w-full h-1 bg-slate-200 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Box Petunjuk Informasi -->
            <div class="bg-slate-50/90 border border-slate-100 rounded-2xl p-3 sm:p-3.5 text-xs text-slate-600 leading-relaxed">
                {{ $activeClaim->notice }}
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-3 pt-1">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition shadow-xs">
                    Unduh Kode Klaim
                </a>

                <form action="{{ route('claims.cancel', $activeClaim->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan klaim ini?')">
                    @csrf
                    <button type="submit" class="border border-rose-300 text-rose-500 hover:bg-rose-50 font-semibold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition">
                        Batalkan klaim
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Bagian Riwayat 10 Aktivitas Sesuai Desain Revisi -->
    <div class="space-y-4 pt-2">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-slate-900">Riwayat</h2>
            <p class="text-xs text-slate-500">Urut dari yang terbaru. Pilih tab untuk melihat satu jenis saja.</p>
        </div>

        <!-- Filter Tab Pills (Semua 10, Upload 3, Kehilangan 4, Klaim 4) -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1">
            <a href="{{ route('claims.index', ['filter' => 'semua']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'semua' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Semua {{ $counts['semua'] }}
            </a>
            <a href="{{ route('claims.index', ['filter' => 'upload']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'upload' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Upload {{ $counts['upload'] }}
            </a>
            <a href="{{ route('claims.index', ['filter' => 'kehilangan']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'kehilangan' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Kehilangan {{ $counts['kehilangan'] }}
            </a>
            <a href="{{ route('claims.index', ['filter' => 'klaim']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $filter === 'klaim' ? 'bg-blue-600 text-white shadow-xs' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Klaim {{ $counts['klaim'] }}
            </a>
        </div>

        <!-- Daftar Kartu Aktivitas -->
        <div class="space-y-3">
            @forelse($activities as $act)
            <div class="bg-white rounded-3xl p-4 sm:p-5 shadow-sm border border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <!-- Foto Placeholder -->
                    <div class="w-14 h-14 bg-slate-200 rounded-2xl flex items-center justify-center text-xs font-semibold text-slate-400 shrink-0">
                        Foto
                    </div>
                    
                    <div class="space-y-1">
                        <!-- Badge Kategori (Klaim / Kehilangan / Upload) -->
                        <div>
                            <span class="inline-block {{ $act->category_color }} text-[10px] font-bold px-2.5 py-0.5 rounded-md">
                                {{ $act->category_label }}
                            </span>
                        </div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-tight">{{ $act->title }}</h3>
                        <p class="text-xs text-slate-400 leading-normal">{{ $act->subtitle }}</p>
                    </div>
                </div>

                <!-- Bagian Status Badge & Tombol Aksi Sesuai Desain -->
                <div class="flex items-center gap-2.5 self-end sm:self-center shrink-0">
                    <!-- Status Badge (Jika Ada) -->
                    @if(!empty($act->status_badge))
                        <span class="{{ $act->status_badge_color }} text-xs px-3.5 py-1 rounded-full font-semibold">
                            {{ $act->status_badge }}
                        </span>
                    @endif

                    <!-- Tombol Aksi / Badge Khusus -->
                    @if(!empty($act->action_button))
                        @if(!empty($act->action_is_badge))
                            <span class="bg-slate-100 text-slate-600 text-xs px-3.5 py-1.5 rounded-xl font-medium">
                                {{ $act->action_button }}
                            </span>
                        @else
                            <a href="#" class="border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-semibold px-4 py-1.5 rounded-xl transition">
                                {{ $act->action_button }}
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-3xl p-8 text-center text-slate-400 text-xs sm:text-sm">
                Belum ada data pada kategori ini.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
