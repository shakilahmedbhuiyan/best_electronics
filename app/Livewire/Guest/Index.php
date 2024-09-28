<?php

namespace App\Livewire\Guest;

use App\Models\store;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

class Index extends Component
{
    use SEOTools;

    public function mount()
    {
        $store = app('store');
        $this->seo()->setTitle($store->description);
        $this->seo()
            ->setDescription($store->description);
        $this->seo()->opengraph()->setTitle($store->name);
        $this->seo()->opengraph()->setDescription($store->description);
        $this->seo()->twitter()->setTitle($store->name);
        $this->seo()->twitter()->setDescription($store->description);
        $this->seo()->jsonLd()->setTitle($store->name);
    }

    public function render()
    {

        return view('livewire.guest.index')
            ->layout('layouts.guest');
    }

    public function category($category)
    {
        $this->seo()->setTitle('Affordable Printing Solutions');
        $this->seo()
            ->setDescription('One-Stop Print Solution. All types of printing services are available in one location. We guarantee high-quality printing for all of your printing needs.');
        $this->seo()->opengraph()->setUrl('https://printnsign.co.uk');
        return view('livewire.guest.category', compact('category'))
            ->layout('layouts.guest');
    }
}
