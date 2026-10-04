@extends('layouts.admin')

@section('title', 'Dashboard Kasir - FreshLaundry')
@section('page-title', 'Overview Transaksi Hari Ini')

@section('content')
<!-- Ringkasan Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-slate-500 text-xs font-semibold mb-1">Pesanan Hari Ini</p>
        <h3 class="text-2xl font-black text-white">18 <span class="text-xs font-normal text-slate-400">Nota</span></h3>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-slate-500 text-xs font-semibold mb-1">Sedang Diproses</p>
        <h3 class="text-2xl font-black text-amber-500">7 <span class="text-xs font-normal text-slate-400">Cucian</span></h3>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-slate-500 text-xs font-semibold mb-1">Siap Diambil</p>
        <h3 class="text-2xl font-black text-emerald-500">5 <span class="text-xs font-normal text-slate-400">Cucian</span></h3>
    </div>
    <div class="bg-slate-900 border border-slate-800 rounded-xl p-4">
        <p class="text-slate-500 text-xs font-semibold mb-1">Pemasukan Kasir (Shift)</p>
        <h3 class="text-2xl font-black text-red-500">Rp 345.000</h3>
    </div>
</div>

<!-- Aksi Cepat & Daftar Pesanan Terbaru -->
<div class="grid lg:grid-cols-12 gap-6">
    <!-- Tabel Pesanan Terbaru -->
    <div class="lg:col-span-8 bg-slate-900 border border-slate-800 rounded-xl p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-bold text-white">Pesanan Terakhir</h3>
            <a href="/kasir/pesanan" class="text-xs text-red-500 hover:underline font-bold">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="bg-slate-950 text-slate-400 uppercase font-semibold">
                    <tr>
                        <th class="p-3">No. Nota</th>
                        <th class="p-3">Pelanggan</th>
                        <th class="p-3">Layanan</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    <tr class="hover:bg-slate-800/30">
                        <td class="p-3 font-bold text-white">#INV-20260930-003</td>
                        <td class="p-3">Ahmad Fauzi</td>
                        <td class="p-3">Cuci Komplit (3.5 kg)</td>
                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-amber-950/80 text-amber-400 border border-amber-800/50 text-[10px] font-bold">Dicuci</span></td>
                        <td class="p-3 text-right font-bold text-white">Rp 24.500</td>
                    </tr>
                    <tr class="hover:bg-slate-800/30">
                        <td class="p-3 font-bold text-white">#INV-20260930-002</td>
                        <td class="p-3">Budi Santoso</td>
                        <td class="p-3">Express 1 Hari (5 kg)</td>
                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-emerald-950/80 text-emerald-400 border border-emerald-800/50 text-[10px] font-bold">Selesai</span></td>
                        <td class="p-3 text-right font-bold text-white">Rp 50.000</td>
                    </tr>
                    <tr class="hover:bg-slate-800/30">
                        <td class="p-3 font-bold text-white">#INV-20260930-001</td>
                        <td class="p-3">Siti Rahma</td>
                        <td class="p-3">Setrika Saja (2 kg)</td>
                        <td class="p-3"><span class="px-2 py-0.5 rounded bg-slate-800 text-slate-300 text-[10px] font-bold">Diterima</span></td>
                        <td class="p-3 text-right font-bold text-white">Rp 8.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Panel Tombol Akses Cepat -->
    <div class="lg:col-span-4 bg-slate-900 border border-slate-800 rounded-xl p-5 flex flex-col justify-between">
        <div>
            <h3 class="text-sm font-bold text-white mb-2">Aksi Cepat Kasir</h3>
            <p class="text-slate-400 text-xs mb-6">Pintasan untuk memproses pesanan dengan cepat.</p>
            
            <div class="space-y-3">
                <a href="/kasir/transaksi/baru" class="w-full py-3 bg-red-600 hover:bg-red-500 text-white font-bold rounded-lg text-xs flex items-center justify-center gap-2 shadow-lg shadow-red-600/20 transition-all">
                    <span>➕</span> Input Transaksi Baru
                </a>
                <a href="/kasir/pelanggan" class="w-full py-3 bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold rounded-lg text-xs flex items-center justify-center gap-2 border border-slate-700 transition-all">
                    <span>🔍</span> Cari Data Pelanggan
                </a>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-800 text-slate-500 text-[11px]">
            💡 Tip: Selalu konfirmasi nomor HP pelanggan untuk pengiriman notifikasi otomatis via WhatsApp.
        </div>
    </div>
</div>
@endsection