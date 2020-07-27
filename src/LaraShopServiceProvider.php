<?php

namespace CobraProjects\LaraShop;

use CobraProjects\LaraShop\LaraShop;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaraShopServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadThings();

        $this->publishThings();
    }

    public function register()
    {
        # code...
    }

    protected function loadThings()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/larashop.php', 'larashop');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'larashop');
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group($this->routeOptions(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/larashop.php');
        });

        Route::group($this->routeAdminOptions(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/larashopadmin.php');
        });
    }

    protected function routeOptions()
    {
        return [
            'prefix' => LaraShop::getPrefix(),
            'namespace' => 'CobraProjects\LaraShop\Http\Controllers',
        ];
    }

    protected function routeAdminOptions()
    {
        return [
            'prefix' => LaraShop::getAdminPrefix(),
            'namespace' => 'CobraProjects\LaraShop\Http\Controllers\Admin',
            'middleware' => ['web', config('larashop.admin_middleware')]
        ];
    }

    protected function publishThings()
    {
        $this->publishes([
            __DIR__ . '/../config/larashop.php' => config_path('larashop.php'),
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/views' => resource_path('views/vendor/larashop/'),
        ]);

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/larashop/'),
        ], 'larashop-views');
    }
}
