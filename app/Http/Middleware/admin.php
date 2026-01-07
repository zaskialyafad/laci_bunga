<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin 
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login DAN rolenya adalah admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); 
        }

        // Jika bukan admin, lempar ke halaman home-page milik user
        return redirect()->route('web.home-page')->with('error', 'Anda tidak memiliki akses Admin.');
    }
}