<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FreshLaundry - Laundry Ceria & Bersih')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-amber-50/40 text-slate-800 min-h-screen flex flex-col selection:bg-red-500 selection:text-white">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-rose-100/80 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo Playful -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-red-500 via-rose-500 to-orange-400 flex items-center justify-center text-white text-xl shadow-lg shadow-red-500/30 group-hover:rotate-6 group-hover:scale-110 transition-all duration-300">
                    🧼
                </div>
                <span class="text-xl font-black tracking-tight text-slate-900">
                    Laundry<span class="text-red-500">Nita</span>
                </span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-xs font-bold uppercase tracking-wider text-slate-600">
                <a href="/" class="hover:text-red-500 transition-colors text-red-500">Beranda</a>
                <a href="#layanan" class="hover:text-red-500 transition-colors">Layanan & Harga</a>
                <a href="#tracking" class="hover:text-red-500 transition-colors">Cek Status</a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->role === 'owner')
                        <a href="/owner/dashboard" class="px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider bg-red-500 hover:bg-red-600 text-white shadow-md shadow-red-500/20 transition-all hover:scale-105">
                            Dashboard Owner
                        </a>
                    @elseif(auth()->user()->role === 'kasir')
                        <a href="/kasir/dashboard" class="px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider bg-red-500 hover:bg-red-600 text-white shadow-md shadow-red-500/20 transition-all hover:scale-105">
                            Dashboard Kasir
                        </a>
                    @else
                        <span class="text-xs text-slate-700 font-bold bg-rose-100/80 px-3.5 py-1.5 rounded-full">
                            👋 Halo, {{ auth()->user()->name }}
                        </span>
                    @endif

                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-slate-500 hover:text-red-500 px-3 py-2 transition-colors">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="/login" class="text-xs font-bold text-slate-700 hover:text-red-500 px-3 py-2 transition-colors">
                        Masuk
                    </a>
                    <a href="/register" class="inline-flex items-center justify-center px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/25 transition-all hover:scale-105 active:scale-95">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Ceria -->
    <footer class="bg-white border-t border-rose-100 py-10 text-slate-500 text-xs">
        <div class="max-w-7xl mx-auto px-4 text-center space-y-3">
            <div class="flex items-center justify-center gap-2 font-black text-slate-900 text-base">
                <span>✨ LaundryNita ✨</span>
            </div>
            <p class="font-medium text-slate-500">&copy; {{ date('Y') }} LaundryNita. Pakaian Bersih, Wangi & Bebas Stres!</p>
            <p class="text-slate-400">Layanan Laundry Antar-Jemput Instant & Real-time Tracking.</p>
        </div>
    </footer>

</body>
</html>