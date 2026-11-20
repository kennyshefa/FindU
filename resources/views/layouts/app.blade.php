<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindU - Klaim Saya</title>
    <!-- Tailwind CSS CDN untuk kemudahan preview langsung -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563EB',
                    }
                }
            }
        }
    </script>
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
<body class="min-h-screen text-slate-800">
    <!-- Navbar -->
    <header class="bg-white border-b border-blue-50/50 sticky top-0 z-30 shadow-sm">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-2 text-blue-600 font-bold text-xl tracking-tight">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                </svg>
                <span>FindU</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600">
                <a href="#" class="hover:text-blue-600 transition-colors">Beranda</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Cari</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Upload</a>
                <a href="{{ route('claims.index') }}" class="text-blue-600 font-semibold relative after:content-[''] after:absolute after:-bottom-[21px] after:left-0 after:right-0 after:h-0.5 after:bg-blue-600">Riwayat</a>
                <a href="#" class="hover:text-blue-600 transition-colors">Tentang Kami</a>
            </nav>

            <!-- User Button -->
            <div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2 rounded-xl transition-all shadow-sm">
                    Saya
                </button>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        @yield('content')
    </main>
</body>
</html>
