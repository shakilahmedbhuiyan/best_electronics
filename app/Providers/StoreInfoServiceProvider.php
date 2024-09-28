<?php

namespace App\Providers;

use App\Models\store;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StoreInfoServiceProvider extends ServiceProvider
{

    private function storeInfo()
    {
        $store = Cache::rememberForever('store-info', function () {
            return Store::first();
        });
        if ($store !== null) {
            return $store;
        }
        return null;
    }

    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->singleton('store', function () {
            return $this->storeInfo();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Config::set('app.name', $this->storeInfo()->name);
        Config::set('seotools.meta.defaults.title', $this->storeInfo()->name);
        Config::set('seotools.opengraph.defaults.site_name', $this->storeInfo()->name);
        View::share('store', $this->storeInfo());

    }
}
