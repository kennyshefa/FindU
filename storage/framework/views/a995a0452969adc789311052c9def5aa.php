<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindU - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #DEE8FC;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between p-6 sm:p-10 text-slate-800">

    <!-- Top: Logo FindU Sesuai Register.png -->
    <header class="w-full max-w-6xl mx-auto">
        <a href="<?php echo e(route('home')); ?>" class="inline-block">
            <img src="<?php echo e(asset('images/logo_findu_clean.png')); ?>" alt="FindU" class="h-10 sm:h-12 w-auto object-contain">
        </a>
    </header>

    <!-- Main Content: Dua Kolom Sesuai Figma Register.png -->
    <main class="w-full max-w-6xl mx-auto my-auto py-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        
        <!-- Kolom Kiri: Karakter Detektif Asli dari Figma -->
        <div class="flex items-center justify-center">
            <img src="<?php echo e(asset('images/auth_man.png')); ?>" alt="Ilustrasi Detektif FindU" class="max-h-[460px] w-auto object-contain drop-shadow-sm">
        </div>

        <!-- Kolom Kanan: Form Register -->
        <div class="w-full max-w-md mx-auto space-y-5">
            <div class="text-center space-y-1">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#EAA023] tracking-tight">Register</h1>
                <p class="text-xs sm:text-sm text-slate-800 font-medium">Masuk ke akun anda untuk melanjutkan</p>
            </div>

            <!-- Form Registrasi & Buka Akun Langsung -->
            <form action="<?php echo e(route('register.post')); ?>" method="POST" class="space-y-3.5">
                <?php echo csrf_field(); ?>
                
                <!-- Nama -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-800">Nama</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="Nama"
                           class="w-full bg-white border border-slate-200/90 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-[#EAA023] shadow-2xs">
                </div>

                <!-- Email -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-800">Email</label>
                    <input type="text" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email"
                           class="w-full bg-white border border-slate-200/90 rounded-xl px-4 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-[#EAA023] shadow-2xs">
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-800">Password</label>
                    <div class="relative flex items-center">
                        <input type="password" id="registerPassword" name="password" placeholder="Password"
                               class="w-full bg-white border border-slate-200/90 rounded-xl pl-4 pr-11 py-2.5 text-xs sm:text-sm focus:outline-none focus:border-[#EAA023] shadow-2xs">
                        <button type="button" onclick="toggleRegisterPassword()" class="absolute right-3.5 text-slate-400 hover:text-slate-600 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Pilih Peran Sesuai Register.png -->
                <div class="space-y-1.5 pt-1">
                    <label class="text-xs font-semibold text-slate-800">Pilih Peran</label>
                    <div class="grid grid-cols-2 gap-3" id="roleSelector">
                        <input type="hidden" name="role" id="selectedRole" value="Pengguna">
                        <button type="button" onclick="selectRole('Pengguna')" id="btnPengguna"
                                class="bg-[#EAA023] text-white font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-xs">
                            Pengguna
                        </button>
                        <button type="button" onclick="selectRole('Petugas')" id="btnPetugas"
                                class="bg-white border border-slate-200 text-slate-700 font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm hover:bg-slate-50 transition shadow-2xs">
                            Petugas
                        </button>
                    </div>
                </div>

                <!-- Tombol Daftar Oranye -->
                <button type="submit" class="w-full bg-[#EAA023] hover:bg-[#D97706] text-white font-bold text-sm py-3.5 rounded-2xl transition shadow-xs mt-2">
                    Daftar
                </button>
            </form>

            <!-- Divider Atau -->
            <div class="flex items-center gap-3">
                <div class="flex-grow h-px bg-slate-300"></div>
                <span class="text-xs text-slate-600 font-medium">Atau</span>
                <div class="flex-grow h-px bg-slate-300"></div>
            </div>

            <!-- Continue with Google -->
            <form action="<?php echo e(route('register.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="name" value="Nadia Nur Awwalia R">
                <input type="hidden" name="email" value="email@student.ub.ac.id">
                <input type="hidden" name="password" value="google-auth">
                <button type="submit" class="w-full bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold text-xs sm:text-sm py-2.5 rounded-2xl transition flex items-center justify-center gap-2.5 shadow-2xs">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Continue with Google</span>
                </button>
            </form>

            <!-- Footer: Sudah punya Akun? -->
            <div class="text-center text-xs text-slate-700">
                Sudah punya Akun? 
                <a href="<?php echo e(route('login')); ?>" class="text-[#EAA023] font-bold hover:underline">
                    Masuk!
                </a>
            </div>
        </div>

    </main>

    <div class="h-4"></div>

    <script>
        function toggleRegisterPassword() {
            const input = document.getElementById('registerPassword');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }

        function selectRole(role) {
            document.getElementById('selectedRole').value = role;
            const btnPengguna = document.getElementById('btnPengguna');
            const btnPetugas = document.getElementById('btnPetugas');

            if (role === 'Pengguna') {
                btnPengguna.className = 'bg-[#EAA023] text-white font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-xs';
                btnPetugas.className = 'bg-white border border-slate-200 text-slate-700 font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm hover:bg-slate-50 transition shadow-2xs';
            } else {
                btnPetugas.className = 'bg-[#EAA023] text-white font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm transition shadow-xs';
                btnPengguna.className = 'bg-white border border-slate-200 text-slate-700 font-semibold py-2.5 px-4 rounded-xl text-xs sm:text-sm hover:bg-slate-50 transition shadow-2xs';
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\new-xampp\htdocs\findu-laravel\resources\views/auth/register.blade.php ENDPATH**/ ?>