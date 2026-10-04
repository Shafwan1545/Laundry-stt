<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - FreshLaundry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4 selection:bg-red-600 selection:text-white relative overflow-hidden">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10 py-6">
        
        <div class="text-center mb-6">
            <a href="/" class="inline-flex items-center gap-2 mb-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-red-600 to-rose-500 text-white font-extrabold flex items-center justify-center shadow-lg shadow-red-600/30">
                    FL
                </div>
                <span class="text-2xl font-black text-white tracking-tight">Fresh<span class="text-red-500">Laundry</span></span>
            </a>
            <h1 class="text-lg font-bold text-slate-200">Buat Akun Pelanggan Baru</h1>
        </div>

        <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-6 shadow-2xl backdrop-blur-xl">
            
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-red-950/80 border border-red-800/60 text-red-300 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/register" method="POST" class="space-y-4 text-xs">
                @csrf

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="Cth: Budi Santoso"
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="email@contoh.com"
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Nomor WA / HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        placeholder="081234567890"
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl uppercase tracking-wider shadow-lg shadow-red-600/25 transition-all mt-2">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-5 pt-4 border-t border-slate-800 text-center text-xs text-slate-400">
                Sudah punya akun? 
                <a href="/login" class="text-red-500 font-bold hover:underline">Masuk</a>
            </div>
        </div>

    </div>

</body>
</html>