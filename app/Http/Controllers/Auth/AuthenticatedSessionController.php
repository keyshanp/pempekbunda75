<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Check if there's a redirect parameter
        $redirect = $request->query('redirect');

        if ($redirect && filter_var($redirect, FILTER_VALIDATE_URL)) {
            // Make sure redirect URL is internal (prevent open redirect)
            $redirectPath = parse_url($redirect, PHP_URL_PATH);
            if ($redirectPath && strpos($redirectPath, '/') === 0) {
                // Allow redirect to admin panel only for legitimate cases
                // (but we'll override this with our own logic below)
                return redirect($redirectPath);
            }
        }

        // Clear any admin-related redirect intentions to prevent unwanted redirects
        if (session()->has('url.intended') && str_starts_with(session('url.intended'), '/admin')) {
            session()->forget('url.intended');
        }

        // Check if user is admin and redirect accordingly
        $user = Auth::user();
        if ($user && $user->is_admin) {
            // Admin users go to admin dashboard
            return redirect('/admin');
        } else {
            // Regular users go to cart/checkout
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
