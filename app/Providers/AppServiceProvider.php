<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;//Schema library
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);//in the create posts table we have added a string, so we need to define its length 
        
        
        
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
