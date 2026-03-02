<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('filament.admin.auth.login');
        }
        
        if (!auth()->user()->is_admin) {
            auth()->logout();
            return redirect()->route('filament.admin.auth.login')
                ->with('error', 'Anda tidak memiliki akses admin.');
        }
        
        return $next($request);
    }
}