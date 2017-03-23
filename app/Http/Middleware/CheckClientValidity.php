<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Client;

class CheckClientValidity
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
        if (Auth::user()->client->dateValidity < Carbon::now()) {
        	$client = Client::find(Auth::user()->id_client);
        	$client->status = 'inactive';
        	$client->update();
        	Auth::logout();
        	return redirect('/validity');
        }
    	return $next($request);
    }
}
