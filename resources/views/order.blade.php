@extends('layouts.app')

@section('title', 'Pesan Laundry Antar-Jemput - FreshLaundry')

@section('content')
<div class="py-12 bg-gradient-to-b from-rose-100/50 via-sky-50/30 to-amber-50/40 text-slate-800 min-h-[calc(100vh-5rem)] relative overflow-hidden" x-data="orderApp()">
    
    <!-- Animasi Gelembung Sabun Dekoratif -->
    <div class="absolute top-10 left-10 w-24 h-24 bg-sky-300/30 rounded-full blur-md animate-bounce pointer-events-none" style="animation-duration: 6s;"></div>
    <div class="absolute top-1/2 right-10 w-32 h-32 bg-rose-300/30 rounded-full blur-md animate-bounce pointer-events-none" style="animation-duration: 4s;"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        
        <!-- Header Judul Playful -->
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white border-2 border-red-200 text-red-500 rounded-full text-xs font-black uppercase tracking-wider shadow-sm transform -rotate-1">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-ping"></span>
                🛵 Penjemputan Cepat 24/7
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 mt-3 tracking-tight">
                Pesan Antar-Jemput <span class="bg-gradient-to-r from-red-500 via-rose-500 to-orange-400 bg-clip-text text-transparent">Praktis!</span>
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-2 font-medium">Santai di rumah, kurir ramah kami siap jemput & antar cucianmu sampai wangi! 🧺✨</p>
        </div>

        <form action="{{ route('order.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            @csrf

            <!-- Flash Message jika Sukses -->
            @if(session('success'))
                <div class="lg:col-span-12 p-4 bg-emerald-100 border-2 border-emerald-300 rounded-2xl text-emerald-800 text-xs font-bold text-center shadow-md">
                    🎉 {{ session('success') }}
                </div>
            @endif

            <!-- KOLOM KIRI: FORM PILIHAN & DATA (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- STEP 1: Pilih Jenis Layanan -->
                <div class="bg-white/90 backdrop-blur-md border-2 border-rose-100 rounded-3xl p-6 shadow-xl shadow-rose-500/5">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-xl bg-red-500 text-white font-black text-xs flex items-center justify-center shadow-md shadow-red-500/20">1</span>
                            <h3 class="text-xs font-black uppercase tracking-wider text-slate-900">Pilih Jenis Layanan</h3>
                        </div>
                        <span class="text-[11px] font-bold text-slate-400">Pilih paket favoritmu 👇</span>
                    </div>

                    <!-- Hidden Input untuk Form backend -->
                    <input type="hidden" name="service_name" :value="selectedService.name">
                    <input type="hidden" name="estimated_weight" :value="weight">

                    <div class="grid grid-cols-2 gap-3.5">
                        <template x-for="item in services" :key="item.id">
                            <div @click="selectedService = item"
                                :class="selectedService.id === item.id ? 'border-red-500 bg-gradient-to-b from-rose-50 to-white ring-2 ring-red-500 shadow-md shadow-red-500/10 scale-[1.02]' : 'border-slate-100 bg-slate-50/50 hover:border-red-200 hover:bg-white'"
                                class="p-4 rounded-2xl border-2 cursor-pointer transition-all duration-200 relative flex flex-col justify-between h-32">
                                
                                <div class="flex justify-between items-start">
                                    <span class="text-3xl" x-text="item.icon"></span>
                                    <span x-show="selectedService.id === item.id" class="w-3 h-3 rounded-full bg-red-500 shadow-sm shadow-red-500"></span>
                                </div>

                                <div>
                                    <h4 class="text-xs font-black text-slate-900 group-hover:text-red-500 transition-colors" x-text="item.name"></h4>
                                    <p class="text-[11px] text-red-500 font-extrabold mt-0.5" x-text="formatRupiah(item.price) + ' / ' + item.unit"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Slider Estimasi Berat / Jumlah -->
                    <div class="mt-6 pt-5 border-t border-rose-100">
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-xs font-bold text-slate-700">Estimasi Berat / Jumlah:</label>
                            <span class="text-sm font-black text-red-500 bg-red-50 px-3 py-1 rounded-xl border border-red-200" x-text="weight + ' ' + selectedService.unit"></span>
                        </div>
                        
                        <input type="range" min="1" max="20" step="0.5" x-model="weight" 
                            class="w-full h-2.5 bg-rose-100 rounded-lg appearance-none cursor-pointer accent-red-500">
                        
                        <div class="flex justify-between text-[10px] font-bold text-slate-400 mt-1">
                            <span>1 Kg</span>
                            <span>10 Kg</span>
                            <span>20+ Kg</span>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: Informasi Pemesan & Lokasi -->
                <div class="bg-white/90 backdrop-blur-md border-2 border-rose-100 rounded-3xl p-6 shadow-xl shadow-rose-500/5 space-y-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-7 h-7 rounded-xl bg-red-500 text-white font-black text-xs flex items-center justify-center shadow-md shadow-red-500/20">2</span>
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-900">Detail Penjemputan</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Nama Lengkap *</label>
                            <input type="text" name="customer_name" x-model="customer.name" required placeholder="Cth: Budi Santoso" 
                                class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white font-bold transition-all">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Nomor WhatsApp *</label>
                            <input type="tel" name="customer_phone" x-model="customer.phone" required placeholder="081234567890" 
                                class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white font-bold transition-all">
                        </div>
                    </div>

                    <div class="text-xs">
                        <label class="block font-bold text-slate-700 mb-1.5">Alamat Penjemputan *</label>
                        <textarea name="address" x-model="customer.address" rows="2" required placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, atau patokan lokasi..." 
                            class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-red-500 focus:bg-white font-medium transition-all"></textarea>
                    </div>
                </div>

                <!-- STEP 3: Waktu Penjemputan -->
                <div class="bg-white/90 backdrop-blur-md border-2 border-rose-100 rounded-3xl p-6 shadow-xl shadow-rose-500/5">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-7 h-7 rounded-xl bg-red-500 text-white font-black text-xs flex items-center justify-center shadow-md shadow-red-500/20">3</span>
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-900">Jadwal Jemput</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Tanggal Penjemputan</label>
                            <input type="date" name="pickup_date" x-model="pickupDate" required 
                                class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 font-bold focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Jam Penjemputan</label>
                            <select name="pickup_time" x-model="pickupSlot" class="w-full px-4 py-3 bg-rose-50/30 border border-rose-200 rounded-2xl text-slate-800 font-bold focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                                <option value="Pagi (08:00 - 11:00)">🌅 Pagi (08:00 - 11:00)</option>
                                <option value="Siang (11:00 - 15:00)">☀️ Siang (11:00 - 15:00)</option>
                                <option value="Sore (15:00 - 18:00)">🌆 Sore (15:00 - 18:00)</option>
                                <option value="Malam (18:00 - 21:00)">🌙 Malam (18:00 - 21:00)</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN: LIVE RECEIPT & CHECKOUT (5 Cols) -->
            <div class="lg:col-span-5 sticky top-24">
                <div class="bg-white border-2 border-rose-200 rounded-3xl p-6 shadow-2xl shadow-rose-500/10 relative overflow-hidden">
                    
                    <!-- Top Stripe Accent -->
                    <div class="absolute top-0 left-0 right-0 h-3 bg-gradient-to-r from-red-500 via-rose-500 to-orange-400"></div>

                    <div class="flex justify-between items-center border-b border-rose-100 pb-4 mb-5 pt-2">
                        <div>
                            <span class="text-[10px] uppercase tracking-widest text-red-500 font-black">Ringkasan Pesanan</span>
                            <h3 class="text-base font-black text-slate-900">FreshLaundry Pass 🏷️</h3>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-emerald-700 font-black bg-emerald-100 border border-emerald-200 px-2.5 py-1 rounded-full">Antar-Jemput</span>
                        </div>
                    </div>

                    <!-- Item Detail List -->
                    <div class="space-y-3 text-xs mb-6">
                        <div class="flex justify-between items-center text-slate-600">
                            <span>Layanan Pilihan:</span>
                            <span class="font-black text-slate-900" x-text="selectedService.name"></span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600">
                            <span>Perkiraan Berat:</span>
                            <span class="font-black text-red-500" x-text="weight + ' ' + selectedService.unit"></span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600">
                            <span>Biaya Antar-Jemput:</span>
                            <span class="font-black text-emerald-600">GRATIS 🎉</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600">
                            <span>Waktu Jemput:</span>
                            <span class="font-bold text-slate-800" x-text="pickupSlot"></span>
                        </div>
                    </div>

                    <!-- Customer Preview Card -->
                    <div class="bg-rose-50/60 rounded-2xl p-4 border border-rose-100 mb-6 space-y-1.5 text-[11px]">
                        <div class="flex justify-between text-slate-600">
                            <span>Nama Pemesan:</span>
                            <span class="font-bold text-slate-900" x-text="customer.name || '-'"></span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>WhatsApp:</span>
                            <span class="font-bold text-slate-900" x-text="customer.phone || '-'"></span>
                        </div>
                        <div class="text-slate-600 truncate">
                            <span>Alamat:</span>
                            <p class="font-bold text-slate-800 truncate mt-0.5" x-text="customer.address || 'Belum diisi...'"></p>
                        </div>
                    </div>

                    <!-- Total Estimasi Harga -->
                    <div class="bg-gradient-to-r from-red-500 via-rose-500 to-orange-400 rounded-2xl p-4 mb-6 text-white shadow-lg shadow-red-500/20">
                        <span class="text-[10px] uppercase font-bold text-rose-100 block mb-0.5">Estimasi Total Biaya:</span>
                        <div class="flex items-baseline justify-between">
                            <span class="text-3xl font-black" x-text="formatRupiah(calculateTotal())"></span>
                            <span class="text-[10px] text-rose-100 font-medium">*Bayar saat cucian selesai</span>
                        </div>
                    </div>

                    <!-- CTA Button Submit -->
                    <button type="submit" 
                        class="w-full py-4 bg-slate-900 hover:bg-slate-800 text-white font-black rounded-2xl text-xs uppercase tracking-wider shadow-xl transition-all hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2">
                        <span>🚀 Kirim Pesanan Sekarang</span>
                    </button>

                    <p class="text-[10px] text-center text-slate-400 font-bold mt-3">
                        🔒 Tanpa DP. Kurir akan konfirmasi WA sebelum berangkat.
                    </p>

                </div>
            </div>

        </form>

    </div>
</div>

<!-- Script Alpine.js Interaktif -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function orderApp() {
        return {
            weight: 3,
            pickupDate: new Date().toISOString().split('T')[0],
            pickupSlot: 'Siang (11:00 - 15:00)',
            customer: {
                name: '',
                phone: '',
                address: ''
            },
            services: [
                { id: 1, name: 'Cuci Komplit Reguler', price: 7000, unit: 'Kg', icon: '🧺' },
                { id: 2, name: 'Express 1 Hari', price: 10000, unit: 'Kg', icon: '⚡' },
                { id: 3, name: 'Setrika Saja', price: 4000, unit: 'Kg', icon: '👔' },
                { id: 4, name: 'Bedcover / Sepatu', price: 25000, unit: 'Pcs', icon: '👟' },
            ],
            selectedService: { id: 1, name: 'Cuci Komplit Reguler', price: 7000, unit: 'Kg', icon: '🧺' },

            calculateTotal() {
                return (this.weight || 0) * (this.selectedService.price || 0);
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
            }
        }
    }
</script>
@endsection