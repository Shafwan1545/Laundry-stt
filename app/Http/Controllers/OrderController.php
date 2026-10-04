<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    // 1. Menyimpan pesanan online dari web pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'address'          => 'required|string',
            'service_name'     => 'required|string',
            'estimated_weight' => 'required|numeric|min:0.5',
            'pickup_date'      => 'required|date',
            'pickup_time'      => 'required|string',
        ]);

        $prices = [
            'Cuci Komplit Reguler' => 7000,
            'Express 1 Hari'       => 10000,
            'Setrika Saja'         => 4000,
            'Bedcover / Sepatu'    => 25000,
        ];

        $unitPrice  = $prices[$request->service_name] ?? 7000;
        $totalPrice = $request->estimated_weight * $unitPrice;

        Order::create([
            'order_number'     => 'ORD-' . strtoupper(uniqid()),
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'address'          => $request->address,
            'service_name'     => $request->service_name,
            'estimated_weight' => $request->estimated_weight,
            'pickup_date'      => $request->pickup_date,
            'pickup_time'      => $request->pickup_time,
            'total_price'      => $totalPrice,
            'status'           => 'Menunggu Jemput',
            'order_type'       => 'online',
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim! Kurir kami akan segera mengonfirmasi via WhatsApp.');
    }

    // 2. Menampilkan daftar pesanan online di Kasir Panel
    public function indexKasir()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('kasir.pesanan', compact('orders'));
    }

    // 3. Update status pesanan dari Kasir Panel + Kirim WA jika Selesai
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        
        // Update status di database
        $order->update(['status' => $request->status]);

        // Jika status diubah menjadi 'Selesai', panggil fungsi kirim WA
        if ($request->status === 'Selesai' && $oldStatus !== 'Selesai') {
            $this->sendWaReceipt($order);
        }

        return redirect()->back()->with('success', 'Status pesanan ' . $order->order_number . ' berhasil diperbarui!');
    }

    // 4. Fungsi Privat Kirim WA via Fonnte API
 private function sendWaReceipt($order)
{
    // Hapus semua karakter selain angka
    $phone = preg_replace('/[^0-9]/', '', $order->customer_phone);

    // Ubah 08xxx menjadi 628xxx
    if (str_starts_with($phone, '0')) {
        $phone = '62' . substr($phone, 1);
    }

    $message = "Halo Kak {$order->customer_name} 👋\n\n"
             . "Cucian kamu dengan nota *#{$order->order_number}* sudah *SELESAI* dan siap diambil/diantar! 🧺✨\n\n"
             . "📋 *Rincian Pesanan:*\n"
             . "• Layanan: {$order->service_name}\n"
             . "• Total Berat: {$order->estimated_weight} Kg/Unit\n"
             . "• Total Biaya: *Rp " . number_format($order->total_price, 0, ',', '.') . "*\n\n"
             . "Terima kasih telah mencuci di *FreshLaundry*! 🙏";

    try {
        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
        ]);

        // Catat respon API ke log Laravel untuk pengecekan
        \Log::info('Fonnte Response: ' . $response->body());

    } catch (\Exception $e) {
        \Log::error('Gagal kirim WA Fonnte: ' . $e->getMessage());
    }
}
}