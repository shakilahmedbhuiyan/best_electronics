<?php

namespace App\Observers;

use App\Models\Brand;
use Spatie\Sitemap\Sitemap;

class BrandObserver
{
    /**
     * Handle the Brand "created" event.
     */
    public function created(Brand $brand): void
    {
        $sitemap = Sitemap::create()
            ->add(Brand::active()->get());

        $sitemap->writeToFile(public_path('brand_sitemap.xml'));
    }

    /**
     * Handle the Brand "updated" event.
     */
    public function updated(Brand $brand): void
    {
        $sitemap = Sitemap::create()
            ->add(Brand::active()->get());

        $sitemap->writeToFile(public_path('brand_sitemap.xml'));
    }

    /**
     * Handle the Brand "deleted" event.
     */
    public function deleted(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "restored" event.
     */
    public function restored(Brand $brand): void
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     */
    public function forceDeleted(Brand $brand): void
    {
        //
    }
}
