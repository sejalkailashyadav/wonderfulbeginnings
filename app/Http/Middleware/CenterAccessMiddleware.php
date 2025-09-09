<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CenterAccessMiddleware
{
    public function handle($request, Closure $next)
    {
         $user = session('user');

    $centerId = $request->route('center_id') ?? $request->input('center_id'); 

    // dd([
    //     'center_id_in_url' => $centerId,
    //     'user_center_id' => $user->center_id ?? 'null',
    //     'user_type' => $user->user_type ?? 'null',
    // ]);
        

        if (!$user) {
            return redirect('/login');
        }

        if ($user->user_type === 'Admin') {
            return $next($request); // Admin can access all centers
        }

        $centerId = $request->route('center_id') ?? $request->input('center_id');

        if ($centerId && $centerId != $user->center_id) {
            return redirect('/dashboard')->with('error', 'Access denied: Wrong center.');
        }

        return $next($request);
    }
}