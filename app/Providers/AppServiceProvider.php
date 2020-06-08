<?php

namespace App\Providers;

use App\Category;
use App\Http\Controllers\BrandsController;
use App\Media;
use App\Observers\CategoryObserver;
use App\Observers\MediaObserver;
use App\Observers\OrderHistoryObserver;
use App\Observers\OrderObserver;
use App\Observers\OrderProductObserver;
use App\Observers\ProductObserver;
use App\Order;
use App\OrderHistory;
use App\OrderProduct;
use App\Product;
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
        Order::observe(OrderObserver::class);
        OrderHistory::observe(OrderHistoryObserver::class);
        Category::observe(CategoryObserver::class);
        Media::observe(MediaObserver::class);
        Product::observe(ProductObserver::class);
        OrderProduct::observe(OrderProductObserver::class);


        // TODO дереткива на створення відобрадення брендів @brands
        Blade::directive('brands', function () {
            return BrandsController::showBrandList();
        });

    }
}
