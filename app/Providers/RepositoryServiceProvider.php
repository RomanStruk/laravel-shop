<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\Repository;
use App\Repositories\RepositoryInterface\OrderRepositoryInterface;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(OrderRepositoryInterface::class, Repository::class);
    }
}
