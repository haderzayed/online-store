<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('Filter',
        function($attribute,$value,$params){
            return ! in_array(strtolower($value),$params);
        },
        'this value not good');
        Paginator::useBootstrapFour();
        // Paginator::defaultView('customeview');
    }
}
