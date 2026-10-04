@extends('layouts.admin')

@section('title', 'Transaksi Baru - FreshLaundry')
@section('page-title', 'Form Input Transaksi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6" x-data="posSystem()">
    
    <!-- KOLOM KIRI: Form Input Data & Layanan (8 Cols) -->
    <div class="lg:col-span-7 space-y-6">
        
        <!-- STEP 1: Data Pelanggan -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-red-600/20 text-red-500 font-bold text-xs flex items-center justify-center">1</span>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Informasi Pelanggan</h3>
                </div>
                <span class="text-[11px] text-slate-500">*Wajib diisi</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-medium text-slate-400 mb-1.5">Nama Pelanggan</label>
                    <input type="text" x-model="customer.name" placeholder="Cth: Budi Santoso" 
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>
                <div>
                    <label class="block font-medium text-slate-400 mb-1.5">Nomor WhatsApp / HP</label>
                    <input type="tel" x-model="customer.phone" placeholder="081234567890" 
                        class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all">
                </div>
            </div>
        </div>

        <!-- STEP 2: Pilih Jenis Layanan & Berat/Jumlah -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-red-600/20 text-red-500 font-bold text-xs flex items-center justify-center">2</span>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Pilih Layanan Laundry</h3>
            </div>

            <!-- Card Pilihan Paket -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-5">
                <template x-for="item in availableServices" :key="item.id">
                    <button type="button" @click="selectService(item)"
                        :class="selectedService.id === item.id ? 'border-red-500 bg-red-600/10 text-white' : 'border-slate-800 bg-slate-950 text-slate-400 hover:border-slate-700'"
                        class="p-3.5 rounded-xl border text-left transition-all relative flex flex-col justify-between h-24">
                        
                        <div class="flex justify-between items-start w-full">
                            <span class="text-xs font-bold" x-text="item.name"></span>
                            <span x-show="selectedService.id === item.id" class="w-2 h-2 rounded-full bg-red-500"></span>
                        </div>

                        <div>
                            <p class="text-[10px] text-slate-500" x-text="'Per ' + item.unit"></p>
                            <p class="text-xs font-extrabold text-red-400" x-text="formatRupiah(item.price)"></p>
                        </div>
                    </button>
                </template>
            </div>

            <!-- Input Jumlah / Berat (Kg atau Pcs) -->
            <div class="bg-slate-950 border border-slate-800/80 rounded-xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-bold text-white" x-text="selectedService.name || 'Pilih Layanan Terlebih Dahulu'"></p>
                    <p class="text-[11px] text-slate-500" x-text="'Harga Satuan: ' + formatRupiah(selectedService.price) + ' / ' + selectedService.unit"></p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" @click="qty > 1 ? qty-- : null" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 text-white font-bold hover:bg-slate-800 active:scale-95 transition-all text-sm flex items-center justify-center">-</button>
                    
                    <div class="text-center w-20">
                        <input type="number" step="0.1" x-model="qty" class="w-full text-center bg-transparent text-white font-bold text-base focus:outline-none">
                        <span class="text-[10px] text-slate-500 uppercase font-semibold" x-text="selectedService.unit"></span>
                    </div>

                    <button type="button" @click="qty++" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 text-white font-bold hover:bg-slate-800 active:scale-95 transition-all text-sm flex items-center justify-center">+</button>
                </div>
            </div>
        </div>

        <!-- STEP 3: Opsi Pembayaran & Catatan -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-4">
                <span class="w-6 h-6 rounded-full bg-red-600/20 text-red-500 font-bold text-xs flex items-center justify-center">3</span>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider">Status Pembayaran & Catatan</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs mb-4">
                <!-- Status Bayar -->
                <div>
                    <label class="block font-medium text-slate-400 mb-1.5">Metode Bayar</label>
                    <select x-model="paymentStatus" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white focus:outline-none focus:border-red-500">
                        <option value="Lunas">Lunas (Tunai/QRIS)</option>
                        <option value="Belum Bayar">Belum Bayar (Bayar Nanti)</option>
                    </select>
                </div>

                <!-- Est. Selesai -->
                <div>
                    <label class="block font-medium text-slate-400 mb-1.5">Estimasi Selesai</label>
                    <input type="date" x-model="estimatedDate" class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white focus:outline-none focus:border-red-500">
                </div>
            </div>

            <div>
                <label class="block font-medium text-slate-400 mb-1.5">Catatan Cucian (Opsional)</label>
                <textarea x-model="notes" rows="2" placeholder="Cth: Baju putih dipisah, luntur, pakai parfum ekstra..." 
                    class="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-red-500 text-xs transition-all"></textarea>
            </div>
        </div>

    </div>

    <!-- KOLOM KANAN: Preview Nota / Struk Real-time (4 Cols) -->
    <div class="lg:col-span-5">
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl sticky top-24">
            
            <div class="border-b border-slate-800 pb-4 mb-4 flex justify-between items-center">
                <div>
                    <h3 class="text-base font-extrabold text-white">Ringkasan Nota</h3>
                    <p class="text-[11px] text-slate-500" x-text="'No. Nota: #' + invoiceNumber"></p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                    :class="paymentStatus === 'Lunas' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20'"
                    x-text="paymentStatus">
                </span>
            </div>

            <!-- Detail Struk -->
            <div class="space-y-3 text-xs mb-6">
                <div class="flex justify-between py-1 border-b border-slate-800/50">
                    <span class="text-slate-400">Pelanggan:</span>
                    <span class="font-bold text-white" x-text="customer.name || '-'"></span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/50">
                    <span class="text-slate-400">WhatsApp:</span>
                    <span class="font-medium text-slate-300" x-text="customer.phone || '-'"></span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/50">
                    <span class="text-slate-400">Layanan:</span>
                    <span class="font-medium text-slate-300" x-text="selectedService.name"></span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/50">
                    <span class="text-slate-400">Jumlah / Berat:</span>
                    <span class="font-bold text-red-400" x-text="qty + ' ' + selectedService.unit"></span>
                </div>
                <div x-show="notes" class="py-1">
                    <span class="text-slate-400 block mb-1">Catatan:</span>
                    <p class="text-[11px] text-slate-300 italic bg-slate-950 p-2 rounded-lg border border-slate-800" x-text="notes"></p>
                </div>
            </div>

            <!-- Total Harga -->
            <div class="bg-slate-950 border border-slate-800 rounded-xl p-4 mb-6">
                <div class="flex justify-between items-center">
                    <span class="text-xs uppercase font-bold text-slate-400">Total Biaya</span>
                    <span class="text-xl font-black text-red-500" x-text="formatRupiah(calculateTotal())"></span>
                </div>
            </div>

            <!-- Tombol Simpan & Cetak -->
            <button type="button" @click="submitOrder()"
                class="w-full py-3.5 bg-red-600 hover:bg-red-500 text-white font-bold rounded-xl text-xs uppercase tracking-wider shadow-lg shadow-red-600/25 transition-all hover:shadow-red-600/40 active:scale-[0.98] flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                <span>Simpan & Cetak Struk</span>
            </button>

        </div>
    </div>

</div>

<!-- Script Alpine.js Interaktif (Tanpa perlu install library tambahan) -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function posSystem() {
        return {
            invoiceNumber: 'FL-' + Math.floor(100000 + Math.random() * 900000),
            customer: { name: '', phone: '' },
            qty: 1,
            paymentStatus: 'Lunas',
            estimatedDate: new Date(Date.now() + 86400000 * 2).toISOString().split('T')[0], // Default H+2
            notes: '',
            
            // Daftar layanan contoh
            availableServices: [
                { id: 1, name: 'Cuci Komplit Express', price: 10000, unit: 'kg' },
                { id: 2, name: 'Cuci Komplit Reguler', price: 7000, unit: 'kg' },
                { id: 3, name: 'Cuci Kering Saja', price: 5000, unit: 'kg' },
                { id: 4, name: 'Setrika Saja', price: 4000, unit: 'kg' },
                { id: 5, name: 'Bed Cover Large', price: 25000, unit: 'pcs' },
                { id: 6, name: 'Sepatu / Tas', price: 30000, unit: 'pcs' },
            ],

            selectedService: { id: 2, name: 'Cuci Komplit Reguler', price: 7000, unit: 'kg' },

            selectService(service) {
                this.selectedService = service;
            },

            calculateTotal() {
                return (this.qty || 0) * (this.selectedService.price || 0);
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
            },

            submitOrder() {
                if(!this.customer.name) {
                    alert('Mohon isi Nama Pelanggan terlebih dahulu!');
                    return;
                }
                alert('Transaksi Berhasil Disimpan!\nNomor Nota: #' + this.invoiceNumber + '\nTotal: ' + this.formatRupiah(this.calculateTotal()));
            }
        }
    }
</script>
@endsection