<?php

namespace App\Providers;

use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
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

            Inertia::share([

        'translations' => function(){
            $lacal=App::getLocale();
            $path=resource_path('lang/{$local}/message.php');
            return File::exists($path) ? require $path : [];
        },
        'locale' =>fn()=>App::getLocale(),
    ]);
     
    }
}
