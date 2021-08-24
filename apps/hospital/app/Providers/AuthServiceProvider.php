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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('see-patients', function ($user) {
            return $user->role_id === config('roles.doctor');
        });
        Gate::define('see-prescriptions', function ($user) {
            return $user->role_id === config('roles.doctor');
        });
        Gate::define('make-prescriptions', function ($user) {
            return $user->role_id === config('roles.doctor');
        });
        Gate::define('delete-prescriptions', function ($user) {
            return $user->role_id === config('roles.doctor');
        });
        Gate::define('make-appointment', function ($user) {
            return $user->role_id === config('roles.receptionist');
        });

        Gate::define('see-appointment', function ($user) {
            return $user->role_id === config('roles.receptionist');
        });

        Gate::define('update-appointment', function ($user) {
            return $user->role_id === config('roles.receptionist');
        });

        Gate::define('delete-appointment', function ($user) {
            return $user->role_id === config('roles.receptionist');
        });

    }
}
