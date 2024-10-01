<?php

namespace App\Livewire\Guest\Product;

use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Single extends Component
{
    use SEOTools;

    public $product;

    public function mount($product)
    {
        $this->product = Cache::rememberForever('product_' . $product, static function () use ($product) {
            $product = Product::where('slug', $product)
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->with('brand', 'category')
                ->firstOrFail();
            return $product->toArray();
        });


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


    public function order($product)
    {
        $product = Product::findOrfail($product);
        $data = [
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->sale ? $product->sale_price : $product->price,
            'status' => 'pending',
        ];
        session()->push('cart', $data);
        return $this->redirect(route('cart'), navigate: true);
    }
}
