<?php

namespace App\Http\Middleware;

use Closure;

class SupervisorMiddleware
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
    	if (Auth::user()->role->description == 'developer' || Auth::user()->role->description == 'admin' || Auth::user()->role->description == 'client' || Auth::user()->role->description == 'maintenance' || Auth::user()->role->description == 'operator' || Auth::user()->role->description == 'upervisor') {
    		return $next($request);
    	}
    	return redirect('/home');
    }
}
