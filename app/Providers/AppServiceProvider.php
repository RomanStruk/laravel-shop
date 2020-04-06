<?php

namespace App\Providers;

use App\Category;
use App\Http\Controllers\BrandsController;
use App\Media;
use App\Observers\CategoryObserver;
use App\Observers\MediaObserver;
use App\Observers\OrderDetailObserver;
use App\Observers\OrderObserver;
use App\Order;
use App\OrderDetail;
use App\Services\Shipping\ShippingInterface;
use App\Services\Shipping\ShippingNovaposhta;
use Blade;
use Illuminate\Pagination\Paginator;
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
        Order::observe(OrderObserver::class);
        OrderDetail::observe(OrderDetailObserver::class);
        Category::observe(CategoryObserver::class);
        Media::observe(MediaObserver::class);

        $this->app->bind(ShippingInterface::class, ShippingNovaposhta::class);

        // TODO дереткива на створення відобрадення брендів @brands
        Blade::directive('brands', function () {
            return BrandsController::showBrandList();
        });

//        Paginator::defaultView('vendor.pagination.default');
//        Paginator::defaultSimpleView('vendor.pagination.default');
    }
}
