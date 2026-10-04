<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

// --- ROUTE PUBLIK ---
Route::get('/', function () {
    return view('welcome');
});
Route::get('/cek', [TransactionController::class, 'track'])->name('tracking');

// --- ROUTE AUTHENTICATION ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ROUTE PANEL KASIR ---
Route::middleware(['auth'])->prefix('kasir')->name('kasir.')->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', function () {
        return view('kasir.dashboard');
    })->name('dashboard');

    // 2. Transaksi Baru
    Route::get('/transaksi/baru', function () {
        return view('kasir.transaksi-baru');
    })->name('transaksi.baru');

    // 3. Daftar Pesanan
    Route::get('/pesanan', function () {
        return view('kasir.pesanan');
    })->name('pesanan');

    // 4. Pelanggan
    Route::get('/pelanggan', function () {
        return view('kasir.pelanggan');
    })->name('pelanggan');

    // 5. Laporan
    Route::get('/laporan', function () {
        return view('kasir.laporan');
    })->name('laporan');
});

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/kasir/pesanan', [OrderController::class, 'indexKasir'])->name('kasir.pesanan');
    
    // Ganti name(...) menjadi 'orders.updateStatus'
    Route::patch('/kasir/pesanan/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// --- ROUTE OWNER ---
Route::middleware(['auth'])->prefix('owner')->group(function () {
    Route::get('/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');
});

// Halaman Form Pesan Laundry (Pelanggan)
Route::get('/pesan', function () {
    return view('order');
})->name('order.form');

// Proses Simpan Pesanan dari Pelanggan
Route::post('/pesan', function (\Illuminate\Http\Request $request) {
    // Nanti simpan data $request ke tabel/database di sini
    return back()->with('success', 'Pesanan Anda berhasil dikirim! Kurir kami akan segera menghubungi Anda.');
})->name('order.store');