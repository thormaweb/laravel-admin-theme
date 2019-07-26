<?php

namespace App\Providers;

use ThormaWeb\AdminTheme\AdminTheme;
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
        // Call the Admin Theme routes.
        AdminTheme::routes();
    }
}