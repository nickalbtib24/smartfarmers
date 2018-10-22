<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Role;

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
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        
        Gate::define('admin-only', function ($user) {
            $roles = $user->roles;
            foreach($roles as $role)
            {
                if($role->name === 'Administrator')
                {
                    return true;
                }
            }
            return false;
        });
        
        Gate::define('normal-only', function ($user) {
            $roles = $user->roles;
            foreach($roles as $role)
            {
                if($role->name === 'CompradorVendedor')
                {
                    return true;
                }
            }
            return false;
        });
      
    }

}
