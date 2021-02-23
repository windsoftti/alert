<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Prospecto::class => ProspectoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('crud-gerentes', function ($user) {

            return $user->tipo_id===1;
        });

        Gate::define('crud-promotores', function ($user) {

            if($user->tipo_id==1 or $user->tipo_id==2){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('crud-personal', function ($user) {

            return $user->tipo_id===1;
        });

        Gate::define('only-gerente', function ($user) {

            return $user->tipo_id===2;
        });

        Gate::define('only-admin', function ($user) {

            return $user->tipo_id===1;
        });

    }
}
