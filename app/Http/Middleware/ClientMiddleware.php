<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class ClientMiddleware
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
        if (Auth::user()->role->description == 'developer' || Auth::user()->role->description == 'admin' || Auth::user()->role->description == 'client') {
        	return $next($request);
        }
        return redirect('/home');
    }
}
