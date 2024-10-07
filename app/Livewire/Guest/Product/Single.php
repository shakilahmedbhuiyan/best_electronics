<?php

namespace App\Livewire\Guest\Product;

use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Single extends Component
{
    use SEOTools;

    public $product;

    public function mount($product)
    {
        $key = 'product_' . $product;
        if (Cache::has($key)) {
            $this->product = Cache::get($key);
        } else {
            $item = Product::where('slug', $product)
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->with('brand', 'category')
                ->first();
            if (!$item || $item === null) {
                 return $this->redirect(route('products.search', $product), navigate: true);
            }
            $this->product = Cache::rememberForever($key, function () use ($item) {
                return $item->toArray();
            });
        }

        $this->seo()->setTitle($this->product['name']);
        $this->seo()
            ->setDescription($this->product['meta_description']);
        $this->seo()->metatags()->setKeywords($this->product['meta_keywords']);

        $this->seo()->metatags()->addMeta('product:published_time', $this->product['created_at']);
        $this->seo()->metatags()->addMeta('product:type', $this->product['category']['name']);
        $this->seo()->metatags()->addMeta('product:tag', $this->product['meta_keywords']);

        $this->seo()->addImages($this->product['thumbnail']);
        $this->seo()->opengraph()->setTitle($this->product['name']);
        $this->seo()->opengraph()->setDescription($this->product['meta_description']);
         $this->seo()->opengraph()->setType('product');
        $this->seo()->twitter()->setTitle($this->product['name']);
        $this->seo()->twitter()->setDescription($this->product['description']);

        $this->seo()->jsonLd()->setTitle($this->product['name']);
        $this->seo()->jsonLd()->setDescription($this->product['description']);
        $this->seo()->jsonLd()->setType('Product');
        $this->seo()->jsonLd()->addImage($this->product['thumbnail']);
        $this->seo()->jsonLd()->addValue('brand', $this->product['brand']['name']);
        $this->seo()->jsonLd()->addValue('category', $this->product['category']['name']);
        $this->seo()->jsonLd()->addValue('price', $this->product['price']);
        $this->seo()->jsonLd()->addValue('currency', 'KSA');
        $this->seo()->jsonLd()->addValue('availability', 'https://schema.org/InStock');
        $this->seo()->jsonLd()->addValue('url', route('product.single', $this->product['slug']));
        $this->seo()->jsonLd()->addValue('sku', $this->product['sku']);
        if ($this->product['sale']) {
            $this->seo()->jsonLd()->addValue('offer', [
                'price' => $this->product['sale_price'],
                'priceCurrency' => 'KSA',
                'availability' => 'https://schema.org/InStock',
                'url' => route('product.single', $this->product['slug']),
            ]);
        }
        $this->seo()->setCanonical(route('product.single', $this->product['slug']));
    }

    public function render()
    {
        if (session()->has('success')) {
            Notification::make()
                ->title('Congrats!')
                ->success()
                ->body(session('success'))
                ->color('success')
                ->iconColor('success')
                ->send();
            session()->forget('success');
        }
        return view('livewire.guest.product.single')
            ->layout('layouts.guest');
    }

    public function addToCart($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        $existingProduct = collect($cart)->firstWhere('product_id', $productId);
        if ($existingProduct) {
            foreach ($cart as &$item) {
                if ($item['product_id'] == $productId) {
                    $item['quantity'] += $quantity;
                    break;
                }
            }
        } else {
            $product = Product::findOrfail($productId);
            $cart[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->sale ? $product->sale_price : $product->price,
                'status' => 'pending',
            ];
        }

        session()->put('cart', $cart);
        session()->flash('success', 'Product added to cart');
    }


    public function order($product)
    {

        $this->addToCart($product, 1);
        return $this->redirect(route('cart'), navigate: true);
    }
}
