<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindU - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #EBF3FF;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Container Utama Sesuai Login.png -->
    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-md border border-slate-100 overflow-hidden grid grid-cols-1 md:grid-cols-2 min-h-[520px]">
        
        <!-- Kolom Kiri: Logo & Ilustrasi Karakter Detektif -->
        <div class="bg-blue-50/60 p-8 flex flex-col justify-between relative overflow-hidden">
            <!-- Brand Logo FindU -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-blue-900 font-extrabold text-2xl tracking-tight z-10">
                <div class="w-8 h-8 rounded-full bg-blue-900 flex items-center justify-center text-white">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                    </svg>
                </div>
                <span>FindU</span>
            </a>

            <!-- Ilustrasi Gambar Karakter Detektif -->
            <div class="my-auto py-6 flex items-center justify-center">
                <img src="{{ asset('designs/Login.png') }}" alt="Ilustrasi Login" class="max-h-72 object-contain mix-blend-multiply">
            </div>

            <div class="text-[11px] text-slate-400 z-10">
                &copy; 2026 FindU &middot; Universitas Brawijaya
            </div>
        </div>

        <!-- Kolom Kanan: Form Login -->
        <div class="p-8 sm:p-12 flex flex-col justify-center space-y-6">
            <div class="text-center space-y-1">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#EAA023]">Login</h1>
                <p class="text-xs text-slate-500">Masuk ke akun anda untuk melanjutkan</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-800">Email</label>
                    <input type="email" placeholder="Email" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-[#EAA023] focus:bg-white transition">
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-800">Password</label>
                    <div class="relative flex items-center">
                        <input type="password" placeholder="Password" required
                               class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-4 pr-10 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-[#EAA023] focus:bg-white transition">
                        <button type="button" class="absolute right-3 text-slate-400 hover:text-slate-600">
                            👁️
                        </button>
                    </div>
                </div>

                <!-- Ingat saya & Lupa password -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" class="rounded border-slate-300 text-[#EAA023] focus:ring-[#EAA023]">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="text-[#EAA023] font-semibold hover:underline">
                        Lupa Password?
                    </a>
                </div>

                <!-- Tombol Login Oranye -->
                <button type="submit" class="w-full bg-[#EAA023] hover:bg-[#D97706] text-white font-bold text-sm py-3 rounded-2xl transition shadow-xs mt-2">
                    Login
                </button>
            </form>

            <!-- Divider Atau -->
            <div class="flex items-center gap-3">
                <div class="flex-grow h-px bg-slate-200"></div>
                <span class="text-xs text-slate-400 font-medium">Atau</span>
                <div class="flex-grow h-px bg-slate-200"></div>
            </div>

            <!-- Continue with Google -->
            <button class="w-full bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold text-xs sm:text-sm py-2.5 rounded-2xl transition flex items-center justify-center gap-2 shadow-2xs">
                <svg class="w-4 h-4" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Continue with Google</span>
            </button>

            <!-- Link Daftar -->
            <div class="text-center text-xs text-slate-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-[#EAA023] font-bold hover:underline">
                    Daftar Sekarang
                </a>
            </div>
        </div>

    </div>

</body>
</html>
