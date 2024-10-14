<?php

namespace App\Observers;

use App\Models\ProductGallery;
use Illuminate\Support\Facades\Cache;

class ProductGalleryObserver
{

    /**
     * Handle the ProductGallery "created" event.
     */
    public function created(ProductGallery $productGallery): void
    {

        $this->product($productGallery);
    }

    /**
     * Handle the ProductGallery "updated" event.
     */
    public function updated(ProductGallery $productGallery): void
    {
        $this->product($productGallery);
    }

    /**
     * Handle the ProductGallery "deleted" event.
     */
    public function deleted(ProductGallery $productGallery): void
    {
        $this->product($productGallery);
    }

    /**
     * @param ProductGallery $productGallery
     * @return void
     */
    public function product(ProductGallery $productGallery): void
    {
        $product = $productGallery->product;

        if (Cache::has('product_' . $product->slug)) {
            Cache::forget('product_' . $product->slug);
        }

        $key = 'product_' . $product->slug;
        $product->load('images', 'category', 'brand');
        Cache::forever($key, $product->toArray());
    }
}
