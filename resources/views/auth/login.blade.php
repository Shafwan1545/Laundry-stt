<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - FreshLaundry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gradient-to-b from-rose-100/60 via-sky-50/40 to-amber-50/50 text-slate-800 min-h-screen flex items-center justify-center p-4 selection:bg-red-500 selection:text-white relative overflow-hidden">

    <!-- Animasi Gelembung Sabun Dekoratif -->
    <div class="absolute top-10 left-10 w-28 h-28 bg-sky-300/30 rounded-full blur-md animate-bounce pointer-events-none" style="animation-duration: 6s;"></div>
    <div class="absolute bottom-10 right-10 w-36 h-36 bg-rose-300/30 rounded-full blur-md animate-bounce pointer-events-none" style="animation-duration: 4s;"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Header Logo Playful -->
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-2 mb-2 group">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-red-500 via-rose-500 to-orange-400 text-white font-black text-lg flex items-center justify-center shadow-lg shadow-red-500/30 group-hover:scale-105 transition-transform">
                    FL
                </div>
                <span class="text-2xl font-black text-slate-900 tracking-tight">Fresh<span class="text-red-500">Laundry</span></span>
            </a>
            <h1 class="text-xl font-black text-slate-900 mt-1">Selamat Datang Kembali! 👋</h1>
            <p class="text-xs font-medium text-slate-500 mt-1">Masuk ke akun Anda untuk mengelola transaksi & kasir</p>
        </div>

        <!-- Kartu Form Login -->
        <div class="bg-white/90 border-2 border-rose-100 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-rose-500/10 backdrop-blur-xl relative overflow-hidden">
            
            <!-- Aksent Lini Atas -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-red-500 via-rose-500 to-orange-400"></div>

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-red-600 text-xs font-bold flex items-center gap-2 shadow-sm">
                    <span class="text-base">⚠️</span>
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-4">
                @csrf <!-- Token CSRF Utama -->

                <div>
                    <label class="block text-xs font-black text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email / No. HP
                    </label>
                    <input type="text" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="email@contoh.com atau 08123456789"
                        class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white font-bold text-xs transition-all">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-black text-slate-700 uppercase tracking-wider">
                            Kata Sandi
                        </label>
                    </div>
                    <input type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white font-bold text-xs transition-all">
                </div>

                <div class="flex items-center gap-2 py-1">
                    <input type="checkbox" id="remember" name="remember" class="rounded-lg bg-rose-50 border-rose-200 text-red-500 focus:ring-red-400 w-4 h-4 cursor-pointer">
                    <label for="remember" class="text-xs font-bold text-slate-600 cursor-pointer">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 px-4 bg-slate-900 hover:bg-slate-800 text-white font-black rounded-2xl text-xs uppercase tracking-wider shadow-xl transition-all hover:scale-[1.02] active:scale-[0.98]">
                    🚀 Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-rose-100 text-center text-xs text-slate-500 font-medium">
                Belum punya akun? 
                <a href="/register" class="text-red-500 font-black hover:underline">Daftar Sekarang</a>
            </div>
        </div>

    </div>

</body>
</html>