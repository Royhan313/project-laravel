<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Import Auth

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return $next($request); // lanjutkan ke halaman admin
        }

        // Redirect jika bukan admin
        return redirect('/'); // atau halaman lain yang sesuai
    }
}
