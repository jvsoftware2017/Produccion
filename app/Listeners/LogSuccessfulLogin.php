<?php

namespace App\Listeners;
use App\User;
use Carbon\Carbon;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Client;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
    	$user = User::find($event->user->id);
    	if ($user->role->description != 'developer' || $user->role->description != 'admin' && $user->client->dateValidity == null) {
    		$client = Client::find($user->id_client);
    		$client->dateValidity = Carbon::now()->addMonth($client->validity);
    		$client->update();
    	}
    	$user->last_login = Carbon::now();
    	
        $user->update();
    }
}
