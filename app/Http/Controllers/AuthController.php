<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Cek apakah username terdaftar di tabel users
        $user = User::where('username', $credentials['username'])->first();

        // Verifikasi password (menggunakan Hash::check atau pencocokan teks biasa jika belum di-hash)
        // Verifikasi password
        if ($user && ($request->password === $user->password || Hash::check($request->password, $user->password))) {

            // Login manual user ke session Laravel
            Auth::login($user);
            $request->session()->regenerate();

            // Arahkan ke dashboard masing-masing berdasarkan 3 role
            switch ($user->role) {
                case 'super_admin':
                    return redirect('/super-admin/dashboard');
                case 'admin':
                    return redirect('/perizinan/dashboard-utama');
                case 'santri':
                    return redirect('/santri/dashboard');
                default:
                    Auth::logout();
                    return redirect('/login')->withErrors(['username' => 'Role tidak dikenali.']);
            }
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
