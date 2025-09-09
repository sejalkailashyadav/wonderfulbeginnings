<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminOnlyMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('user') || Session::get('user')->user_type !== 'Admin') {
            return redirect('/dashboard')->with('error', 'Access Denied: Admin only.');
        }

        return $next($request);
    }
}