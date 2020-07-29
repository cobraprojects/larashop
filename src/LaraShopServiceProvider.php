<?php

namespace CobraProjects\LaraShop;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Console\Commands\Install;

class LaraShopServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadThings();

        $this->publishThings();

        $this->loadCommands();
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
        $this->loadViewsFrom(__DIR__ . '/views-admin', 'multiauth');
        $this->registerFacades();
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
            'name' => 'admin.',
            'namespace' => 'CobraProjects\LaraShop\Http\Controllers\Admin',
            'middleware' => ['web', config('larashop.admin_middleware')],
        ];
    }

    protected function publishThings()
    {
        $this->publishes([
            __DIR__ . '/../config/larashop.php' => config_path('larashop.php'),
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/views' => resource_path('views/vendor/larashop/'),
            __DIR__ . '/views-admin' => resource_path('views/vendor/multiauth/'),
        ]);

        $this->publishes([
            __DIR__ . '/../config/larashop.php' => config_path('larashop.php'),
        ], 'larashop-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'larashop-migrations');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/larashop/'),
            __DIR__ . '/views-admin' => resource_path('views/vendor/multiauth/'),
        ], 'larashop-views');
    }

    protected function registerFacades()
    {
        $this->app->singleton('LaraShop', function ($app) {
            return new \CobraProjects\LaraShop\LaraShop();
        });
    }

    protected function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
            ]);
        }
    }
}
