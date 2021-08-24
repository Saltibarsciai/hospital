<?php

namespace App\Providers;

use App\Models\Prescription;
use App\Observers\PrescriptionsObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https');
        Prescription::observe(PrescriptionsObserver::class);
    }
}
