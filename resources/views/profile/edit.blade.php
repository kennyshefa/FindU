@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Notifikasi Sukses -->
    @if (session('success_profile'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-2xl text-xs sm:text-sm font-semibold flex items-center justify-between shadow-2xs">
            <span>{{ session('success_profile') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold ml-4">✕</button>
        </div>
    @endif

    @if (session('success_password'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-2xl text-xs sm:text-sm font-semibold flex items-center justify-between shadow-2xs">
            <span>{{ session('success_password') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold ml-4">✕</button>
        </div>
    @endif

    <!-- Card 1: Edit Profil -->
    <section class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Header Banner Krem dengan Dekorasi Lingkaran -->
        <div class="relative bg-[#FFF3EA] p-6 sm:p-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4 overflow-hidden">
            <div class="absolute -right-6 -top-8 w-36 h-36 rounded-full bg-[#FFE3CF] pointer-events-none"></div>

            <div class="flex items-center gap-4 relative z-10">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#EAA023] text-white font-black text-2xl sm:text-3xl flex items-center justify-center shadow-xs shrink-0">
                    {{ strtoupper(substr($user->display_name ?? $user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-lg sm:text-xl font-bold text-slate-900 tracking-tight">Edit Profil</h1>
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $user->email }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="inline-block bg-[#FFE7D4] text-[#C27803] text-[11px] font-bold px-3.5 py-0.5 rounded-full">
                            {{ $user->role ?? 'Mahasiswa' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="relative z-10">
                <a href="{{ route('profile') }}" class="inline-flex items-center gap-1.5 border border-[#F59E0B] bg-white/90 hover:bg-white text-[#D97706] text-xs font-semibold px-4 py-2 rounded-xl transition shadow-2xs">
                    &lsaquo; Kembali ke Profil
                </a>
            </div>
        </div>

        <!-- Form Edit Profil -->
        <form action="{{ route('profile.update') }}" method="POST" class="p-6 sm:p-8 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->display_name ?? $user->name) }}"
                        required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm text-slate-900 border @error('name') border-rose-400 @else border-slate-200 @enderror rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                    />
                    @error('name')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email (Readonly) -->
                <div>
                    <label for="email" class="block font-bold text-slate-700 mb-1.5">Email</label>
                    <input
                        type="email"
                        id="email"
                        value="{{ $user->email }}"
                        disabled
                        class="w-full px-4 py-2.5 text-xs sm:text-sm text-slate-400 bg-slate-50 border border-slate-200 rounded-2xl cursor-not-allowed"
                    />
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label for="phone" class="block font-bold text-slate-700 mb-1.5">Nomor Telepon</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="+62 812 3456 7890"
                        required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm text-slate-900 border @error('phone') border-rose-400 @else border-slate-200 @enderror rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                    />
                    @error('phone')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIM -->
                <div>
                    <label for="nim" class="block font-bold text-slate-700 mb-1.5">NIM</label>
                    <input
                        type="text"
                        id="nim"
                        name="nim"
                        value="{{ old('nim', $user->nim) }}"
                        placeholder="Masukkan NIM"
                        required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm text-slate-900 border @error('nim') border-rose-400 @else border-slate-200 @enderror rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                    />
                    @error('nim')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fakultas -->
                <div>
                    <label for="faculty" class="block font-bold text-slate-700 mb-1.5">Fakultas</label>
                    @php
                        $faculties = [
                            'Ilmu Komputer',
                            'Teknik',
                            'Ekonomi dan Bisnis',
                            'Ilmu Administrasi',
                            'Hukum',
                            'Kedokteran',
                            'Ilmu Sosial dan Ilmu Politik',
                            'Ilmu Budaya',
                            'Pertanian',
                            'Matematika dan Ilmu Pengetahuan Alam',
                        ];
                        $currentFaculty = old('faculty', $user->fakultas ?? $user->faculty);
                    @endphp
                    <select
                        id="faculty"
                        name="faculty"
                        class="w-full px-4 py-2.5 text-xs sm:text-sm text-slate-900 border @error('faculty') border-rose-400 @else border-slate-200 @enderror rounded-2xl bg-white focus:outline-none focus:border-[#F59E0B]"
                    >
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty }}" {{ $currentFaculty === $faculty ? 'selected' : '' }}>
                                {{ $faculty }}
                            </option>
                        @endforeach
                    </select>
                    @error('faculty')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div>
                    <label for="major" class="block font-bold text-slate-700 mb-1.5">Program Studi</label>
                    <input
                        type="text"
                        id="major"
                        name="major"
                        value="{{ old('major', $user->prodi ?? $user->major) }}"
                        placeholder="Contoh: Pendidikan Teknologi Informasi (PTI)"
                        required
                        class="w-full px-4 py-2.5 text-xs sm:text-sm text-slate-900 border @error('major') border-rose-400 @else border-slate-200 @enderror rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                    />
                    @error('major')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Angkatan -->
                <div class="sm:col-span-2">
                    <label for="batch" class="block font-bold text-slate-700 mb-1.5">Angkatan</label>
                    @php
                        $currentBatch = old('batch', $user->angkatan ?? $user->batch);
                    @endphp
                    <select
                        id="batch"
                        name="batch"
                        class="w-full sm:w-1/2 px-4 py-2.5 text-xs sm:text-sm text-slate-900 border @error('batch') border-rose-400 @else border-slate-200 @enderror rounded-2xl bg-white focus:outline-none focus:border-[#F59E0B]"
                    >
                        @foreach (['2026', '2025', '2024', '2023', '2022', '2021'] as $year)
                            <option value="{{ $year }}" {{ (string) $currentBatch === $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    @error('batch')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('profile') }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200/70 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-[#EAA023] hover:bg-[#D97706] transition cursor-pointer shadow-xs">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </section>

    <!-- Card 2: Ubah Password -->
    <section id="ubah-password" class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 sm:p-8">
        <div class="flex items-center gap-3 pb-4 mb-5 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-[#FFF3E8] text-[#EAA023] flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-sm sm:text-base font-bold text-slate-900">Ubah Password</h2>
                <p class="text-xs text-slate-400">Pastikan password baru minimal 8 karakter dan mudah diingat.</p>
            </div>
        </div>

        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            @method('PUT')

            <!-- Password Lama -->
            <div>
                <label for="current_password" class="block font-bold text-slate-700 mb-1.5">Password Lama</label>
                <div class="relative">
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        placeholder="Masukkan password lama"
                        required
                        class="w-full px-4 py-2.5 pr-11 text-xs sm:text-sm text-slate-900 border @error('current_password') border-rose-400 @else border-slate-200 @enderror rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                    />
                    <button type="button" onclick="togglePassword('current_password')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('current_password')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Baru & Konfirmasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block font-bold text-slate-700 mb-1.5">Password Baru</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            required
                            class="w-full px-4 py-2.5 pr-11 text-xs sm:text-sm text-slate-900 border @error('password') border-rose-400 @else border-slate-200 @enderror rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                        />
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block font-bold text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            required
                            class="w-full px-4 py-2.5 pr-11 text-xs sm:text-sm text-slate-900 border border-slate-200 rounded-2xl focus:outline-none focus:border-[#F59E0B]"
                        />
                        <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="pt-3 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold text-white bg-[#132A6B] hover:bg-[#0F2156] transition cursor-pointer">
                    Simpan Password
                </button>
            </div>
        </form>
    </section>

</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection