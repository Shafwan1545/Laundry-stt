<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login (Universal: Owner, Kasir, Pelanggan)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // Login bisa pakai email atau nomor telepon
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$loginType => $request->email, 'password' => $request->password], $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Auto Redirect berdasarkan Role di Database
            if ($user->role === 'owner') {
                return redirect()->intended('/owner/dashboard');
            } elseif ($user->role === 'kasir') {
                return redirect()->intended('/kasir/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email/No. HP atau kata sandi yang dimasukkan salah.',
        ])->onlyInput('email');
    }

    // Form Register (Untuk Pelanggan Baru)
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi Pelanggan
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan', // Default selalu pelanggan
        ]);

        Auth::login($user);

        return redirect('/');
    }

    // Logout
public function logout(Request $request)
{
    Auth::logout();

    // Hapus dan reset sesi user
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Kembalikan ke halaman login
    return redirect('/');
}
}