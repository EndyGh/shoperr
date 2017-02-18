<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        // only admins have access
        $gate->define('admin-access', function($user){
            return $user->hasRole('admin');
        });

        // admins and managers have access
        $gate->define('manager-access', function($user){
            return $user->hasRole('manager') || $user->hasRole('admin');
        });

        // customers,managers and admins have access
        $gate->define('customer-access', function($user){
            return $user->hasRole('customer')
            || $user->hasRole('manager')
            || $user->hasRole('admin');
        });
    }
}
