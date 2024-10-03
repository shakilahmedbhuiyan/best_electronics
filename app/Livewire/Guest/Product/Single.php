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
        }
        else {
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
