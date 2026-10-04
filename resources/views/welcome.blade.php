@extends('layouts.app')

@section('title', 'FreshLaundry - Solusi Laundry Ceria & Praktis!')

@section('content')
<!-- Hero Section Ceria & Lucu -->
<section class="relative py-16 lg:py-24 overflow-hidden bg-gradient-to-b from-rose-100/50 via-sky-50/40 to-amber-50/20">
    
    <!-- Animasi Gelembung Sabun (Floating Bubbles Decorative) -->
    <div class="absolute top-12 left-10 w-20 h-20 bg-sky-300/30 rounded-full blur-md animate-bounce pointer-events-none" style="animation-duration: 6s;"></div>
    <div class="absolute top-1/3 right-12 w-28 h-28 bg-rose-300/30 rounded-full blur-md animate-bounce pointer-events-none" style="animation-duration: 4s;"></div>
    <div class="absolute bottom-10 left-1/3 w-16 h-16 bg-amber-300/40 rounded-full blur-sm animate-pulse pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            <!-- Column Kiri: Headline & Action -->
            <div class="lg:col-span-7 text-center lg:text-left space-y-6">
                
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border-2 border-red-200 text-red-500 text-xs font-black uppercase tracking-wider shadow-md shadow-red-500/10 transform -rotate-1">
                    <span>✨ Cucian Menumpuk? Serahkan Pada Kami! 🧺</span>
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-[1.15]">
                    Cucian Bersih,<br/>
                    Wangi Merekah,<br/>
                    <span class="bg-gradient-to-r from-red-500 via-rose-500 to-orange-400 bg-clip-text text-transparent">
                        Hati Jadi Bahagia! 🫧
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 max-w-xl mx-auto lg:mx-0 font-medium leading-relaxed">
                    Tinggal klik, kurir ramah kami langsung meluncur jemput pakaianmu. Pantau status cucian *real-time* tanpa perlu keluar rumah!
                </p>

                <!-- Tombol CTA Utama -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('order.form') }}" 
                       class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-red-500 via-rose-500 to-orange-400 hover:from-red-600 hover:to-orange-500 text-white font-black text-sm uppercase tracking-wider rounded-3xl shadow-xl shadow-red-500/30 transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-3">
                        <span class="text-xl">🛵</span>
                        <span>Pesan Antar-Jemput Gratis</span>
                    </a>
                </div>

                <!-- Box Search Tracking Resi -->
                <div id="tracking" class="pt-4">
                    <div class="max-w-md mx-auto lg:mx-0 bg-white p-3.5 rounded-3xl border-2 border-rose-100 shadow-xl shadow-rose-500/5">
                        <p class="text-xs text-slate-600 font-extrabold mb-2 text-left px-2 flex items-center gap-1.5">
                            <span>🔍</span> Cek Status Cucianmu
                        </p>
                        <form action="/cek" method="GET" class="flex items-center gap-2">
                            <input type="text" name="nota" placeholder="Ketik No. Nota (Cth: INV-001)" required 
                                class="flex-grow px-4 py-3 bg-rose-50/50 border border-rose-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white text-xs font-bold transition-all">
                            <button type="submit" 
                                class="px-5 py-3 bg-slate-900 hover:bg-slate-800 text-white font-black rounded-2xl transition-all text-xs whitespace-nowrap shadow-md hover:scale-105 active:scale-95">
                                Cek Nota
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Column Kanan: Cards Fitur Ceria -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                
                <div class="bg-white border-2 border-red-100 rounded-3xl p-5 shadow-lg shadow-red-500/5 hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 text-red-500 flex items-center justify-center text-2xl font-bold mb-3 group-hover:rotate-12 transition-transform">
                        ⚡
                    </div>
                    <h4 class="text-slate-900 font-black text-sm mb-1">Super Kilat</h4>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">24 Jam selesai, siap pakai untuk acara pentingmu!</p>
                </div>

                <div class="bg-white border-2 border-sky-100 rounded-3xl p-5 shadow-lg shadow-sky-500/5 hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-500 flex items-center justify-center text-2xl font-bold mb-3 group-hover:rotate-12 transition-transform">
                        🌸
                    </div>
                    <h4 class="text-slate-900 font-black text-sm mb-1">Wangi Tahan Lama</h4>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">Parfum premium pilihan yang segar hingga ke lemari.</p>
                </div>

                <div class="bg-white border-2 border-emerald-100 rounded-3xl p-5 shadow-lg shadow-emerald-500/5 hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-500 flex items-center justify-center text-2xl font-bold mb-3 group-hover:rotate-12 transition-transform">
                        📱
                    </div>
                    <h4 class="text-slate-900 font-black text-sm mb-1">Kabar Via WA</h4>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">Dapat notifikasi otomatis saat cucian siap diantar.</p>
                </div>

                <div class="bg-white border-2 border-amber-100 rounded-3xl p-5 shadow-lg shadow-amber-500/5 hover:scale-105 transition-all duration-300 relative overflow-hidden group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-500 flex items-center justify-center text-2xl font-bold mb-3 group-hover:rotate-12 transition-transform">
                        🏷️
                    </div>
                    <h4 class="text-slate-900 font-black text-sm mb-1">Jujur & Ramah</h4>
                    <p class="text-slate-500 text-xs font-medium leading-relaxed">Timbangan transparan, tanpa biaya tersembunyi.</p>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Section Alur Kerja Cepat (Bagaimana Cara Kerjanya?) -->
<section class="py-12 bg-white border-y border-rose-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs font-black uppercase tracking-widest text-red-500 bg-red-50 px-3 py-1 rounded-full">3 Langkah Mudah</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">Gak Pakai Ribet!</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="bg-amber-50/60 p-6 rounded-3xl border border-amber-100 space-y-2">
                <div class="w-12 h-12 bg-amber-400 text-slate-900 font-black text-lg rounded-full flex items-center justify-center mx-auto shadow-md">1</div>
                <h3 class="font-black text-slate-900 text-sm">Pesan Online</h3>
                <p class="text-slate-500 text-xs font-medium">Isi form pemesanan dan tentukan lokasi penjemputanmu.</p>
            </div>
            <div class="bg-rose-50/60 p-6 rounded-3xl border border-rose-100 space-y-2">
                <div class="w-12 h-12 bg-red-500 text-white font-black text-lg rounded-full flex items-center justify-center mx-auto shadow-md">2</div>
                <h3 class="font-black text-slate-900 text-sm">Kurir Jemput</h3>
                <p class="text-slate-500 text-xs font-medium">Kurir kami mengambil pakaian kotor langsung di depan rumah.</p>
            </div>
            <div class="bg-sky-50/60 p-6 rounded-3xl border border-sky-100 space-y-2">
                <div class="w-12 h-12 bg-sky-400 text-slate-900 font-black text-lg rounded-full flex items-center justify-center mx-auto shadow-md">3</div>
                <h3 class="font-black text-slate-900 text-sm">Antar Kembali</h3>
                <p class="text-slate-500 text-xs font-medium">Pakaian kembali bersih, rapi, dan wangi siap pakai!</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section Bergaya Pop & Friendly -->
<section id="layanan" class="py-16 bg-gradient-to-b from-amber-50/30 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-12">
            <span class="text-xs font-black uppercase tracking-widest text-red-500 bg-red-100 px-3 py-1 rounded-full">Hemat & Terjangkau</span>
            <h2 class="text-3xl font-black text-slate-900 mt-2 mb-2">Pilihan Paket Favorit</h2>
            <p class="text-slate-500 text-xs sm:text-sm font-medium">Pilih paket pencucian yang paling pas buat kebutuhanmu!</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 items-stretch">
            
            <!-- Card Paket 1 -->
            <div class="bg-white border-2 border-slate-100 rounded-3xl p-8 flex flex-col justify-between hover:border-red-300 transition-all shadow-xl shadow-slate-200/50 hover:scale-105">
                <div>
                    <div class="text-3xl mb-2">🧺</div>
                    <h3 class="text-xl font-black text-slate-900 mb-1">Cuci Komplit</h3>
                    <p class="text-slate-500 text-xs mb-6 font-medium">Cuci bersih, pengeringan, setrika uap, plus pewangi wangi tahan lama.</p>
                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="text-3xl font-black text-red-500">Rp 7.000</span>
                        <span class="text-slate-400 text-xs font-extrabold">/ kg</span>
                    </div>
                </div>
                <div>
                    <div class="border-t border-slate-100 pt-4 text-xs font-bold text-slate-600 space-y-2 mb-6">
                        <p class="flex items-center gap-2 text-emerald-600">✓ Selesai 2 Hari</p>
                        <p class="flex items-center gap-2">✓ Packing Rapi & Pres</p>
                    </div>
                    <a href="{{ route('order.form') }}" class="block w-full py-3.5 text-center bg-slate-900 hover:bg-slate-800 text-white font-black text-xs rounded-2xl transition-all shadow-md">
                        Pesan Paket Ini
                    </a>
                </div>
            </div>

            <!-- Card Paket 2 (Featured Hot Offer) -->
            <div class="bg-gradient-to-b from-red-500 via-rose-500 to-orange-500 rounded-3xl p-8 text-white flex flex-col justify-between shadow-2xl shadow-red-500/30 relative transform md:-translate-y-3 border-4 border-amber-300">
                <span class="absolute -top-4 right-6 bg-amber-300 text-slate-900 text-[11px] font-black uppercase px-4 py-1.5 rounded-full shadow-lg border border-amber-400">
                    👑 Paling Laris!
                </span>
                <div>
                    <div class="text-3xl mb-2">🚀</div>
                    <h3 class="text-xl font-black text-white mb-1">Express 1 Hari</h3>
                    <p class="text-rose-100 text-xs mb-6 font-medium">Solusi darurat! Baju kotor selesai dan wangi maksimal dalam 24 jam.</p>
                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="text-4xl font-black text-white">Rp 10.000</span>
                        <span class="text-rose-200 text-xs font-extrabold">/ kg</span>
                    </div>
                </div>
                <div>
                    <div class="border-t border-rose-400/50 pt-4 text-xs font-bold text-rose-100 space-y-2 mb-6">
                        <p class="flex items-center gap-2 text-amber-200 font-extrabold">✓ Prioritas Utama Antrean</p>
                        <p class="flex items-center gap-2">✓ Parfum Ekstra Grade A+</p>
                    </div>
                    <a href="{{ route('order.form') }}" class="block w-full py-3.5 text-center bg-amber-300 hover:bg-amber-400 text-slate-900 font-black text-xs uppercase tracking-wider rounded-2xl shadow-lg transition-all hover:scale-105">
                        Pesan Express Sekarang!
                    </a>
                </div>
            </div>

            <!-- Card Paket 3 -->
            <div class="bg-white border-2 border-slate-100 rounded-3xl p-8 flex flex-col justify-between hover:border-red-300 transition-all shadow-xl shadow-slate-200/50 hover:scale-105">
                <div>
                    <div class="text-3xl mb-2">👔</div>
                    <h3 class="text-xl font-black text-slate-900 mb-1">Setrika Licin</h3>
                    <p class="text-slate-500 text-xs mb-6 font-medium">Pengeringan & setrika uap presisi agar pakaian rapi siap gantung.</p>
                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="text-3xl font-black text-red-500">Rp 4.000</span>
                        <span class="text-slate-400 text-xs font-extrabold">/ kg</span>
                    </div>
                </div>
                <div>
                    <div class="border-t border-slate-100 pt-4 text-xs font-bold text-slate-600 space-y-2 mb-6">
                        <p class="flex items-center gap-2">✓ Setrika Uap Panas Pas</p>
                        <p class="flex items-center gap-2">✓ Lipatan Rapi Presisi</p>
                    </div>
                    <a href="{{ route('order.form') }}" class="block w-full py-3.5 text-center bg-slate-900 hover:bg-slate-800 text-white font-black text-xs rounded-2xl transition-all shadow-md">
                        Pesan Paket Ini
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection