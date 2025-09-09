<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AdminOrManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Session::get('user');

        if (!$user || !in_array($user->user_type, ['Admin', 'Manager'])) {
            return redirect('/dashboard')->with('error', 'Access Denied.');
        }

        return $next($request);
    }
}
