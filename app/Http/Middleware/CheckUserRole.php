<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role_id == 1) {
                return redirect()->route('home')->with('error', 'Access denied.');
            }
            if (in_array($user->role_id, [2, 3, 4])) {
                return $next($request);
            }
        }
        return redirect()->route('login');
    }
}

