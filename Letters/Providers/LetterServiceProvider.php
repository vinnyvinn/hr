<?php
namespace Letters\Providers;

use Illuminate\Support\ServiceProvider;

/**
* manage letters module
*/
class LetterServiceProvider  extends ServiceProvider
{
	
	 /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

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