<?php

namespace App\Providers;

use App\Http\Controllers\AttributeController;
use Blade;
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
        // TODO дереткива на створення відобрадення брендів @brands
        Blade::directive('brands', function () {
            return \App\Http\Controllers\BrandsController::showBrandList();
        });

        // @include('sidebar.content-single-sidebar')
        //view()->composer('sidebar.content-single-sidebar', 'App\Http\Controllers\AttributeController@compose');
    }
}
