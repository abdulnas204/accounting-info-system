<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CompanyInfoProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Helpers\CompanyInfo', function ($app) {
            return new CompanyInfo();
    }
}
