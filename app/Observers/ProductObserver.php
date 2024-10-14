<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Sitemap;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Cache::forget('product_' . $product->slug);
        Cache::forever('product_' . $product->slug, $product->load('category', 'brand', 'images')->toArray());


        $allProducts = Product::active()
            ->inStock()
            ->with('category', 'brand', 'images');

        // Generate the sitemap
        $sitemap = Sitemap::create()
            ->add($allProducts->get());
        $sitemap->writeToFile(public_path('product_sitemap.xml'));


        // Cache the products collection
        $products = $allProducts->orderBy('price', 'desc')->paginate(12);
        $key = 'products-page-1';
        Cache::forget($key);
        Cache::flexible($key, [300, now()->addDays(5)], function () use ($products) {
            return $products;
        });

        // Cache the latest devices
        Cache::forget('latestDevices');
//        Cache::flexible('latestDevices',[100, now()->addDays(5)], function () use ($allProducts) {
//            return $allProducts->orderBy('updated_at', 'desc')->take(8)->get();
//        });

        // Cache the brand latest devices
        $key = $product->brand->slug . '_devices';
        Cache::forget($key);
        Cache::forever($key, $allProducts->where('brand_id', $product->brand_id)
            ->limit(4)
            ->orderBy('created_at', 'desc')
            ->get());

        $key = "brand-" . $product->brand->slug . "-products-page-1";
        Cache::forget($key);

        $key = "category-" . $product->category->slug . "-products-page-1";
        Cache::forget($key);

    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->updated($product);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
