<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class UserMiddleware
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
        if (Auth::user()->role->description == 'developer' || Auth::user()->role->description == 'admin' || Auth::user()->role->description == 'client' || Auth::user()->role->description == 'reports' || Auth::user()->role->description == 'user') {
        	return $next($request);
        }
        return redirect('/home');
    }
}
