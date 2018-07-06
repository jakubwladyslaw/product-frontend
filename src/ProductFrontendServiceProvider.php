<?php

namespace Jakub\ProductFrontend;

use Illuminate\Support\ServiceProvider;
use Jakub\ProductFrontend\Repositories\ProductRest;

class ProductFrontendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configSource = realpath($raw = __DIR__ . '/../config/product-frontend.php') ?: $raw;
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'product-frontend');
        $this->mergeConfigFrom($configSource, 'product-frontend');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRest::class, function ($app) {

            return new ProductRest(config('product-frontend'));
        });

    }
}
