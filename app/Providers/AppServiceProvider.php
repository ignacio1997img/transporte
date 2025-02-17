<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;    
use TCG\Voyager\Facades\Voyager;
// use App\Models\Country;
// use App\Observers\CountryObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        // Registrar el Observer para el modelo Country y departsment "Eliminacion logica"
        // Country::observe(CountryObserver::class);

    }
}
