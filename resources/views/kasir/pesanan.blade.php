@extends('layouts.admin')

@section('title', 'Daftar Pesanan - FreshLaundry')
@section('page-title', 'Daftar Pesanan Cucian')

@section('content')
<div class="space-y-6">

    <!-- Header & Ringkasan -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-black text-white mb-1">Daftar Semua Pesanan 📦</h2>
            <p class="text-xs text-slate-400">Pantau status pencucian, pesanan online, dan transaksi pelanggan di sini.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-slate-800 border border-slate-700 rounded-xl text-xs font-bold text-slate-300">
                Total: <span class="text-red-400 font-extrabold">{{ $orders->count() }}</span> Pesanan
            </span>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-xs font-bold flex items-center gap-2">
            <span>✅</span>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Tabel Daftar Pesanan -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead class="bg-slate-950/80 text-slate-400 uppercase text-[10px] font-bold tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="p-4">No. Nota</th>
                        <th class="p-4">Pelanggan</th>
                        <th class="p-4">Layanan</th>
                        <th class="p-4">Jadwal Jemput</th>
                        <th class="p-4">Alamat</th>
                        <th class="p-4">Tipe</th>
                        <th class="p-4">Est. Total</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium text-slate-300">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-800/40 transition-colors">
                        <td class="p-4 font-bold text-white tracking-wide">
                            {{ $order->order_number }}
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-white">{{ $order->customer_name }}</div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="text-[11px] text-emerald-400 font-semibold hover:underline inline-flex items-center gap-1 mt-0.5">
                                💬 {{ $order->customer_phone }}
                            </a>
                        </td>
                        <td class="p-4">
                            <span class="font-bold text-slate-200">{{ $order->service_name }}</span>
                            <div class="text-[10px] text-slate-400">{{ $order->estimated_weight }} Unit/Kg</div>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-slate-200">{{ \Carbon\Carbon::parse($order->pickup_date)->format('d M Y') }}</div>
                            <div class="text-[10px] text-red-400 font-medium">{{ $order->pickup_time }}</div>
                        </td>
                        <td class="p-4 max-w-xs truncate text-slate-400" title="{{ $order->address }}">
                            {{ $order->address }}
                        </td>
                        <td class="p-4">
                            @if(($order->order_type ?? 'online') === 'online')
                                <span class="px-2 py-0.5 bg-sky-500/10 text-sky-400 border border-sky-500/20 rounded-md text-[10px] font-bold">Online</span>
                            @else
                                <span class="px-2 py-0.5 bg-slate-800 text-slate-400 border border-slate-700 rounded-md text-[10px] font-bold">Walk-in</span>
                            @endif
                        </td>
                        <td class="p-4 font-black text-red-400">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                @if($order->status == 'Menunggu Jemput') bg-amber-500/10 text-amber-400 border border-amber-500/20
                                @elseif($order->status == 'Diproses') bg-sky-500/10 text-sky-400 border border-sky-500/20
                                @elseif($order->status == 'Selesai') bg-emerald-500/10 text-emerald-400 border border-emerald-500/20
                                @else bg-slate-800 text-slate-400 @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="px-2.5 py-1.5 bg-slate-950 border border-slate-700 rounded-xl text-xs font-semibold text-slate-200 focus:outline-none focus:border-red-500 cursor-pointer">
                                    <option value="Menunggu Jemput" {{ $order->status == 'Menunggu Jemput' ? 'selected' : '' }}>Menunggu Jemput</option>
                                    <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="p-8 text-center text-slate-500 font-semibold">
                            Belum ada pesanan yang masuk 📭
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection