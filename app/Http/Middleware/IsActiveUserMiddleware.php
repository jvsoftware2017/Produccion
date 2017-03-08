<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsActiveUserMiddleware
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
    	
    	if (Auth::user()->status == 'active' && Auth::user()->client->status == 'active'){
    		return $next($request);
    	}
    	
    	Auth::logout();
    	return redirect('/active');
    }
}
