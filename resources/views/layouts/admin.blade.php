<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Kasir - FreshLaundry')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between hidden md:flex shrink-0">
        <div>
            <!-- Brand Logo -->
            <div class="h-16 px-6 flex items-center border-b border-slate-800 gap-3">
                <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center font-bold text-white text-sm shadow-md shadow-red-600/30">
                    FL
                </div>
                <span class="font-extrabold text-base tracking-tight text-white">Kasir <span class="text-red-500">Panel</span></span>
            </div>

            <!-- Menu Links -->
        <nav class="p-4 space-y-1 text-xs font-semibold uppercase tracking-wider">
            <a href="{{ route('kasir.dashboard') }}" 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('kasir.dashboard') ? 'bg-red-600 text-white font-bold shadow-md shadow-red-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                📊 Dashboard
            </a>
            
            <a href="{{ route('kasir.transaksi.baru') }}" 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('kasir.transaksi.baru') ? 'bg-red-600 text-white font-bold shadow-md shadow-red-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                ➕ Transaksi Baru
            </a>

            <a href="{{ route('kasir.pesanan') }}" 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('kasir.pesanan') ? 'bg-red-600 text-white font-bold shadow-md shadow-red-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                📋 Daftar Pesanan
            </a>

            <a href="{{ route('kasir.pelanggan') }}" 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('kasir.pelanggan') ? 'bg-red-600 text-white font-bold shadow-md shadow-red-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                👥 Pelanggan
            </a>

            <a href="{{ route('kasir.laporan') }}" 
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-colors {{ request()->routeIs('kasir.laporan') ? 'bg-red-600 text-white font-bold shadow-md shadow-red-600/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                📈 Laporan
            </a>
        </nav>
        </div>

        <!-- User Info -->
        <div class="p-4 border-t border-slate-800 flex items-center justify-between text-xs">
            <div>
                <p class="font-bold text-white">Siti Kasir</p>
                <p class="text-slate-500">Kasir Shift Pagi</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="inline-block m-0 p-0">
    @csrf
    <button type="submit" class="text-xs font-bold text-slate-400 hover:text-red-500 transition-colors cursor-pointer flex items-center gap-2">
        <!-- Icon Logout (opsional) -->
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
        <span>Keluar</span>
    </button>
</form>
        </div>
    </aside>

    <!-- Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Top Bar -->
        <header class="h-16 border-b border-slate-800 bg-slate-900/50 backdrop-blur-md px-6 flex items-center justify-between">
            <h1 class="text-sm font-bold text-slate-200">@yield('page-title', 'Dashboard Kasir')</h1>
            <div class="text-xs text-slate-400">
                Tanggal: <span class="font-bold text-white">{{ date('d M Y') }}</span>
            </div>
        </header>

        <!-- Main Content View -->
        <main class="p-6 flex-grow">
            @yield('content')
        </main>
    </div>

</body>
</html>