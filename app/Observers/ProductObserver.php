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
        $sitemap = Sitemap::create()
            ->add(Product::active()->inStock()->get());
        $sitemap->writeToFile(public_path('product_sitemap.xml'));

        Cache::flush();
        $products = Product::active()
            ->inStock()
            ->with('category', 'brand')
            ->orderBy('price')
            ->paginate(12);
        $key = 'products-collection-page-' . $products->currentPage();
        Cache::forever($key, $products);
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
