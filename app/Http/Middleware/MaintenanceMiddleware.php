<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class MaintenanceMiddleware
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
        if (Auth::user()->roles->description == 'developer' || Auth::user()->roles->description == 'admin' || Auth::user()->roles->description == 'client' || Auth::user()->roles->description == 'maintenance') {
        	return $next($request);
        }
        return redirect('/home');
    }
}
