<?php

namespace App\Providers;

use App\Event;
use App\Notice;
use App\User;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

       View::share('events', Event::all());
        View::share('notices',Notice::all());


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
