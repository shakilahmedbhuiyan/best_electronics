<?php

namespace App\Livewire\Guest;


use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Index extends Component
{
    use SEOTools;

    public function mount()
    {
        $store = app('store');
        $this->seo()->setTitle($store['description']);
        $this->seo()
            ->setDescription($store['description']);
        $this->seo()->opengraph()->setTitle($store['name']);
        $this->seo()->opengraph()->setDescription($store['description']);
        $this->seo()->twitter()->setTitle($store['name']);
        $this->seo()->twitter()->setDescription($store['description']);
        $this->seo()->jsonLd()->setTitle($store['name']);
    }

    public function render()
    {

        return view('livewire.guest.index')
            ->layout('layouts.guest');
    }

    public function category($category)
    {
        return view('livewire.guest.category', compact('category'))
            ->layout('layouts.guest');
    }
}
