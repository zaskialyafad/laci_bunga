<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\user;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->status == 'admin') {
            return redirect('admin/view-data');
        } elseif ($user->status == 'user') {
            return redirect('web-home-page');
        }
        
        return $next($request);
    }
}