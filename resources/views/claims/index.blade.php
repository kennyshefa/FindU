@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-blue-600 tracking-tight">Klaim Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Pantau klaim aktif, kode, dan bukti serah terima dalam satu halaman.</p>
    </div>

    <!-- Summary Metrics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Card 1: Total klaim -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $totalClaims }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Total klaim</div>
        </div>

        <!-- Card 2: Menunggu -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $waitingCount }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Menunggu</div>
        </div>

        <!-- Card 3: Selesai -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $completedCount }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Selesai</div>
        </div>

        <!-- Card 4: Ditolak / kedaluwarsa -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
            <div class="text-3xl font-black text-blue-600">{{ $rejectedOrExpiredCount }}</div>
            <div class="text-xs font-medium text-slate-500 mt-1">Ditolak / kedaluwarsa</div>
        </div>
    </div>

    <!-- Section: Klaim Aktif -->
    @if($activeClaim)
    <div class="space-y-3">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Klaim Aktif</h2>
            <p class="text-xs text-slate-500">Tunjukkan kode ini ke satpam di {{ $activeClaim->location }} sebelum {{ is_string($activeClaim->expired_at) ? $activeClaim->expired_at : $activeClaim->expired_at->translatedFormat('d M Y') }}.</p>
        </div>

        <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-slate-100 space-y-6">
            <!-- Header Klaim Aktif (QR, Kode, Info Barang) -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-2">
                <div class="flex items-center gap-5">
                    <!-- QR Code Mockup -->
                    <div class="w-24 h-24 bg-white border border-slate-300 rounded-xl p-2 flex flex-col justify-between shadow-sm shrink-0">
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
                            <span class="inline-block bg-amber-50 text-amber-700 border border-amber-200/80 text-xs px-3 py-1 rounded-full font-medium">
                                Menunggu verifikasi
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Info Barang & Foto -->
                <div class="flex items-center gap-4 bg-slate-50/70 p-3 sm:p-4 rounded-xl border border-slate-100">
                    <div class="w-14 h-14 bg-slate-200 rounded-xl flex items-center justify-center text-xs font-semibold text-slate-400 shrink-0">
                        @if(!empty($activeClaim->item_photo))
                            <img src="{{ asset('storage/' . $activeClaim->item_photo) }}" alt="{{ $activeClaim->item_name }}" class="w-full h-full object-cover rounded-xl">
                        @else
                            Foto
                        @endif
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">{{ $activeClaim->item_name }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Disimpan di {{ $activeClaim->location }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">Berlaku 7 hari. Setelah itu klaim kedaluwarsa.</p>
                    </div>
                </div>
            </div>

            <!-- Stepper Timeline Progress -->
            <div class="pt-2">
                <div class="grid grid-cols-4 gap-2 text-center text-xs font-medium text-slate-500">
                    <div class="flex flex-col items-center">
                        <span class="text-slate-800 font-semibold mb-2">Klaim diajukan</span>
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

            <!-- Notice Callout -->
            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 text-xs text-slate-600 leading-relaxed">
                {{ $activeClaim->notice ?? 'Bawa KTM dan ingat kapan (jam) serta di mana kamu merasa kehilangan barang ini. Kode hanya nomor antrean, bukan bukti kepemilikan.' }}
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-1">
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm px-5 py-2.5 rounded-xl transition shadow-sm">
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

    <!-- Section: Riwayat -->
    <div class="space-y-3 pt-2">
        <div>
            <h2 class="text-lg font-bold text-slate-900">Riwayat</h2>
            <p class="text-xs text-slate-500">Klaim yang sudah selesai, ditolak, atau kedaluwarsa.</p>
        </div>

        <!-- Filter Tabs / Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1">
            <a href="{{ route('claims.index', ['filter' => 'semua']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $filter === 'semua' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Semua
            </a>
            <a href="{{ route('claims.index', ['filter' => 'selesai']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $filter === 'selesai' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Selesai
            </a>
            <a href="{{ route('claims.index', ['filter' => 'ditolak']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $filter === 'ditolak' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Ditolak
            </a>
            <a href="{{ route('claims.index', ['filter' => 'kedaluwarsa']) }}" 
               class="px-4 py-1.5 rounded-full text-xs font-semibold transition-all {{ $filter === 'kedaluwarsa' ? 'bg-blue-600 text-white shadow-sm' : 'bg-blue-50/80 text-blue-600 hover:bg-blue-100' }}">
                Kedaluwarsa
            </a>
        </div>

        <!-- History Items List -->
        <div class="space-y-3">
            @forelse($historyClaims as $item)
            <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-slate-100">
                <!-- Baris Utama Item -->
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-slate-200 rounded-xl flex items-center justify-center text-xs font-semibold text-slate-400 shrink-0">
                            Foto
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-900">{{ $item->item_name }}</h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                {{ $item->claim_code }} &middot; {{ $item->date_text ?? $item->status }}
                            </p>
                        </div>
                    </div>

                    <!-- Status Badge & Action -->
                    <div class="flex items-center gap-3">
                        @if($item->status === 'selesai')
                            <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 text-xs px-3 py-1 rounded-full font-semibold">
                                Klaim berhasil
                            </span>
                        @elseif($item->status === 'ditolak')
                            <span class="bg-rose-50 text-rose-600 border border-rose-200 text-xs px-3 py-1 rounded-full font-semibold">
                                Ditolak
                            </span>
                            @if(!empty($item->can_appeal))
                            <a href="#" class="border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-medium px-3.5 py-1.5 rounded-lg transition">
                                Ajukan keberatan
                            </a>
                            @endif
                        @elseif($item->status === 'kedaluwarsa')
                            <span class="bg-slate-100 text-slate-600 border border-slate-200 text-xs px-3 py-1 rounded-full font-semibold">
                                Kedaluwarsa
                            </span>
                            @if(!empty($item->can_reclaim))
                            <a href="#" class="border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-medium px-3.5 py-1.5 rounded-lg transition">
                                Klaim lagi
                            </a>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Subcard Jejak Serah Terima (Untuk yang selesai / memiliki bukti) -->
                @if(!empty($item->has_timeline))
                <div class="mt-4 bg-[#EDF3FC] rounded-xl p-4 flex flex-col sm:flex-row gap-4">
                    <!-- Foto Serah Terima -->
                    <div class="w-24 h-24 bg-slate-200 rounded-xl flex items-center justify-center text-[11px] font-semibold text-slate-400 text-center p-2 leading-tight shrink-0">
                        Foto serah terima
                    </div>

                    <!-- Jejak Timeline -->
                    <div class="flex-1 space-y-2 text-xs">
                        <div class="font-bold text-slate-900">Jejak serah terima</div>
                        
                        @if(!empty($item->timeline))
                            @foreach($item->timeline as $log)
                            <div class="text-slate-600">
                                <span class="font-medium text-slate-800">{{ $log['time'] }}</span> &middot; {{ $log['desc'] }}
                            </div>
                            @endforeach
                        @endif

                        <div class="text-slate-500 pt-1 text-[11px]">
                            Jejak ini hanya terlihat oleh kamu, petugas, dan admin. Keberatan dapat diajukan sampai {{ $item->objection_deadline ?? '27 Nov 2026' }}: 
                            <a href="#" class="text-blue-600 font-semibold hover:underline">Ajukan keberatan</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-2xl p-8 text-center text-slate-400 text-sm">
                Belum ada riwayat klaim pada kategori ini.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
