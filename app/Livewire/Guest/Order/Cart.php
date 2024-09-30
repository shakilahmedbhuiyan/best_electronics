<?php

namespace App\Livewire\Guest\Order;

use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Cart extends Component
{
    use SEOTools;

    protected $listeners = ['updateCartQuantity', 'removeFromCart'];
    public $cartItems;
    public ?array $customer=[];

    public function mount()
    {
        $this->seo()->setTitle('Cart');
        $this->seo()->setDescription('Items you put in your cart');

        $cart = session()->get('cart');
        if (!$cart || empty($cart)) {
            return $this->cartItems = [];
        }
        $productIds = collect($cart)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)
            ->where('quantity', '>', 0)
            ->whereNotNull('quantity')
            ->where('status', true)
            ->with('category')
            ->get();

        return $this->cartItems = collect($cart)->map(function ($item) use ($products) {
            $product = $products->where('id', $item['product_id'])->first();

            return [
                'product' => $product,   // Full product details
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'status' => $item['status'],
            ];
        });
    }

    public function updateCartQuantity($productId, $quantity)
    {

        $cart = session()->get('cart', []);
        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] = $quantity;
                break;
            }
        }
        session()->put('cart', $cart);
        $this->cartItems = $cart;

    }

    public function removeFromCart($productId)
    {
        // Get the current cart from the session
        $cart = session()->get('cart', []);

        // Remove the specific product from the cart
        $cart = collect($cart)
            ->reject(static function ($item) use ($productId) {
                return $item['product_id'] == $productId;
            })
            ->values()
            ->toArray();

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Update the Livewire component's cartItems
        $this->cartItems = $cart;
    }

    public function checkout()
    {
        dd(session()->get('cart'));
    }

    public function render()
    {
        return view('livewire.guest.order.cart')
            ->layout('layouts.guest');
    }
}
