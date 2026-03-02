<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('filament.pages.auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            $request->session()->regenerate();
            
            // 🔥 CEK APAKAH ADA PARAMETER REDIRECT
            if ($request->has('redirect')) {
                return redirect($request->redirect);
            }
            
            // 🔥 JIKA ADMIN, REDIRECT KE ADMIN PANEL
            if (isset($user->is_admin) && $user->is_admin) {
                return redirect('/admin');
            }
            
            // 🔥 JIKA USER BIASA, REDIRECT KE CART
            return redirect()->route('order.cart');
        }

        Session::flash('error', 'Email atau password salah.');
        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login')->with('status', 'Anda telah logout dari admin panel.');
    }
}