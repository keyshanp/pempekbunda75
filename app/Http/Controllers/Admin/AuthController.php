<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login admin
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tambahkan pengecekan role admin
        $credentials['is_admin'] = true;

        // Coba login dengan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'))
                ->with('status', 'Login admin berhasil! Selamat datang.');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan administrator.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login')
            ->with('status', 'Anda telah logout dari admin panel.');
    }

    /**
     * Show password reset form
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }
}