<?php

namespace App\Providers;

use App\Models\store;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StoreInfoServiceProvider extends ServiceProvider
{

    private function storeInfo()
    {
        $store = Cache::rememberForever('store-info', static function () {
            if (Schema::hasTable('stores')) {
                $info = Store::first();
                if ($info !== null && $info->exists()) {
                    return $info->toArray();
                }
            }

            return [
                'name' => config('app.name'),
                'description' => 'Store Description',
                'address' => 'Store Address',
                'phone' => 'Store Phone',
                'email' => 'Store Email',
                'map_link' => 'Store Map Link',
                'logo' => '/logo/logo.png',
                'favicon' => '/favicon.ico',
                'facebook' => 'Store Facebook',
                'twitter' => 'Store Twitter',
                'instagram' => 'Store Instagram',
                'linkedin' => 'Store Linkedin',
                'youtube' => 'Store Youtube',
                'pinterest' => 'Store Pinterest',
                'whatsapp' => 'Store Whatsapp',
                'telegram' => 'Store Telegram',
                'snapchat' => 'Store Snapchat',
                'tiktok' => 'Store Tiktok',

            ];
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
        Config::set('app.name', $this->storeInfo()['name']);
        Config::set('seotools.meta.defaults.title', $this->storeInfo()['name']);
        Config::set('seotools.opengraph.defaults.site_name', $this->storeInfo()['name']);
        View::share('store', $this->storeInfo());

    }
}
