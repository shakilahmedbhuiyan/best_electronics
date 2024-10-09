<?php

namespace App\Observers;

use App\Models\HomeSlider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeSliderObserver
{
    /**
     * Handle the HomeSlider "created" event.
     */
    public function created(HomeSlider $homeSlider): void
    {
        Cache::forever('home-sliders', HomeSlider::active()->get());
    }

    /**
     * Handle the HomeSlider "updated" event.
     */
    public function updated(HomeSlider $homeSlider): void
    {
        Cache::forget('home-sliders');
        Cache::forever('home-sliders', HomeSlider::active()->get());
    }

    /**
     * Handle the HomeSlider "deleted" event.
     */
    public function deleted(HomeSlider $homeSlider): void
    {
        Storage::disk('public')->exists($homeSlider->image) ?
            Storage::disk('public')->delete($homeSlider->image) :
            null;
    }

    /**
     * Handle the HomeSlider "restored" event.
     */
    public function restored(HomeSlider $homeSlider): void
    {
        //
    }

    /**
     * Handle the HomeSlider "force deleted" event.
     */
    public function forceDeleted(HomeSlider $homeSlider): void
    {

    }
}
