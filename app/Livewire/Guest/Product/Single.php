<?php

namespace App\Livewire\Guest\Product;

use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Single extends Component
{
    use SEOTools;

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product->Load('category', 'brand')->toArray();

        $this->seo()->setTitle($this->product['name']);
        $this->seo()
            ->setDescription($this->product['description']);
        $this->seo()->metatags()->addMeta('article:published_time', $this->product['created_at']);
        $this->seo()->metatags()->addMeta('article:section', $this->product['category']['name']);
        $this->seo()->metatags()->addMeta('article:tag', $this->product['brand']['name']);
        $this->seo()->addImages($this->product['thumbnail']);
        $this->seo()->opengraph()->setTitle($this->product['name']);
        $this->seo()->opengraph()->setDescription($this->product['description']);
        $this->seo()->twitter()->setTitle($this->product['name']);
        $this->seo()->twitter()->setDescription($this->product['description']);
        $this->seo()->jsonLd()->setTitle($this->product['name']);
        $this->seo()->jsonLd()->setDescription($this->product['description']);
    }
    public function render()
    {
        return view('livewire.guest.product.single')
            ->layout('layouts.guest');
    }
}
