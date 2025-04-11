<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        
        $this->app->singleton('firebase', function ($app) {
            return (new Factory)->withServiceAccount(config('firebase.credentials'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {



        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }   
    }
}
