<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        if (app()->environment('local')) {
            config(['app.debug' => true]);
        }

        if (request()->ip() == env('APP_DEBUG_IP')) {
            config(['app.debug' => true]);
        }
    }
}
