<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle password reset directly (tanpa email token)
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak ditemukan di sistem',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak cocok dengan konfirmasi',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
        ]);

        // Cek apakah email adalah email admin
        $adminEmails = [
            'admin@pempekbunda75.com',
            'superadmin@pempekbunda75.com',
            'bunda75@pempekbunda75.com'
        ];

        if (in_array(strtolower($validated['email']), array_map('strtolower', $adminEmails))) {
            return back()->withErrors([
                'email' => 'Akun admin tidak dapat melakukan reset password. Silakan hubungi administrator untuk bantuan.'
            ])->withInput($request->only('email'));
        }

        // Cari user berdasarkan email
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('status', 'Password berhasil diperbarui! Silakan login dengan password baru Anda.');
    }
}
