<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    	App\User::class => App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->registerPolicies();
    	
    	Gate::define('developer', function ($user) {
    		return $user->role->description == 'developer';
    	});
    	
    	Gate::define('admin', function ($user) {
    		return $user->role->description == 'admin';
    	});
    	
    	Gate::define('client', function ($user) {
    		return $user->role->description == 'client';
    	});
    	
    	Gate::define('reports', function ($user) {
    		return $user->role->description == 'reports';
    	});
    	
    	Gate::define('user', function ($user) {
    		return $user->role->description == 'user';
    	});
    }
}
