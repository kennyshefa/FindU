@extends('layouts.app')

@section('title', 'Detail Barang - ' . $item->name)

@section('content')
<div class="space-y-6">

    <!-- Layout 2 Kolom Sesuai DETAIL BARANG.png -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- Kolom Kiri: Foto & Informasi Barang (2 Kolom) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Card Foto & Judul -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-100 space-y-4">
                <div class="w-full h-72 sm:h-96 rounded-2xl overflow-hidden bg-slate-100">
                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                </div>

                <div class="space-y-1 pt-1">
                    <div>
    <span class="inline-block {{ $item->type === 'hilang' ? 'bg-amber-50 text-amber-700 border border-amber-200/80' : 'bg-emerald-50 text-emerald-600 border border-emerald-200/80' }} text-[11px] font-bold px-3 py-0.5 rounded-md">
        {{ ucfirst($item->type) }}
    </span>
</div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $item->name }}</h1>
                    <p class="text-xs sm:text-sm text-slate-500">{{ $item->description }}</p>
                </div>
            </div>

            <!-- Card Informasi Barang Detail -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-100 space-y-5">
                <h2 class="text-base font-bold text-slate-900">Informasi Barang</h2>

                <div class="divide-y divide-slate-100 text-xs sm:text-sm">
                    <div class="py-3 flex justify-between items-center">
                        <span class="text-slate-400 font-medium w-1/3">Kategori</span>
                        <span class="text-slate-900 font-bold w-2/3">{{ $item->category }}</span>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <span class="text-slate-400 font-medium w-1/3">Ditemukan di</span>
                        <span class="text-slate-900 font-bold w-2/3">{{ $item->location }}</span>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <span class="text-slate-400 font-medium w-1/3">Tanggal ditemukan</span>
                        <span class="text-slate-900 font-bold w-2/3">{{ $item->found_date }}</span>
                    </div>
                    <div class="py-3 flex justify-between items-start">
                        <span class="text-slate-400 font-medium w-1/3 pt-0.5">Disimpan di</span>
                        <div class="w-2/3">
                            <div class="text-slate-900 font-bold">{{ $item->stored_at }}</div>
                            <div class="text-[11px] text-slate-400">{{ $item->stored_note }}</div>
                        </div>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <span class="text-slate-400 font-medium w-1/3">Status</span>
                        <span class="text-slate-900 font-bold w-2/3">{{ $item->status }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Aksi Klaim & Catatan (1 Kolom) -->
        <div class="space-y-6">

            <!-- Card: Ini Barangmu? -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-100 space-y-5">
                <div class="space-y-1">
                    <h3 class="text-base font-bold text-slate-900">Ini Barangmu?</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Tekan klaim untuk dapatkan kode, lalu datang ke Pos Satpam
                    </p>
                </div>

                <!-- Tombol Klaim Barang -->
                <form action="{{ route('items.claim.submit', $item->id) }}" method="POST">
    @csrf
    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm py-3 rounded-xl transition shadow-xs text-center block">
        Klaim Barang ini
    </button>
</form>

                <!-- 3 Langkah Prosedur -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-start gap-3 text-xs text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 font-bold text-[11px] flex items-center justify-center shrink-0 mt-0.5">
                            1
                        </span>
                        <p class="leading-relaxed">Kode klaim dibuat setelah kamu menekan tombol klaim</p>
                    </div>
                    <div class="flex items-start gap-3 text-xs text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 font-bold text-[11px] flex items-center justify-center shrink-0 mt-0.5">
                            2
                        </span>
                        <p class="leading-relaxed">Datang ke pos satpam dalam 7 hari dengan KTM</p>
                    </div>
                    <div class="flex items-start gap-3 text-xs text-slate-600">
                        <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 font-bold text-[11px] flex items-center justify-center shrink-0 mt-0.5">
                            3
                        </span>
                        <p class="leading-relaxed">Satpam memverifikasi, lalu menyerahkan barang</p>
                    </div>
                </div>
            </div>

            <!-- Callout Catatan Penting Sesuai Figma -->
            <div class="bg-[#FFF5EC] border border-[#FEDDC7] rounded-3xl p-5 text-xs text-[#9A5B13] leading-relaxed">
                Satu barang hanya punya satu klaim aktif. Jika sedang diklaim orang lain, tombol berubah menjadi Sedang diklaim. Klaim palsu dapat membuat akunmu dibatasi
            </div>

        </div>

    </div>

</div>
@endsection
