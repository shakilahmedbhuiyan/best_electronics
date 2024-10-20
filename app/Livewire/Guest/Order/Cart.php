<?php

namespace App\Livewire\Guest\Order;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Cart extends Component
{
    use SEOTools;

    protected $listeners = ['updateCartQuantity', 'removeFromCart'];
    public $cartItems;

    protected $validationAttributes = [
        'customer.name' => 'name',
        'customer.mobile' => 'mobile',
        'customer.id_no' => 'Identity Number',
        'customer.nationality' => 'nationality',
        'customer.dob' => 'Date of Birth',
    ];

    public ?array $customers = [];
    public ?array $customer = [];

    public function mount()
    {
        $this->seo()->setTitle('Cart');
        $this->seo()->setDescription('Items in your cart');
        $cart = session()->get('cart');
        if (!$cart || empty($cart)) {
            return $this->cartItems = [];
        }
        $productIds = collect($cart)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productIds)
            ->where('quantity', '>', 0)
            ->where('status', true)
            ->with('category')
            ->get();

        $this->cartItems = collect($cart)->map(function ($item) use ($products) {
            $product = $products->where('id', $item['product_id'])->first();
            if (!$product) {
                return null;
            }
            return [
                'product' => $product->toArray(),
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'status' => $item['status'],
            ];
        })->filter();
        session()->put('cart', $this->cartItems->toArray());
        return $this->cartItems->toArray();
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

    public function checkout()
    {
        $cart = collect(session()->get('cart', []))->filter(function ($item) {
            return $item['quantity'] > 0;
        })->toArray();

        $this->validate([
            'customer.name' => 'required|string',
            'customer.mobile' => 'required|numeric|digits_between:9,15',
            'customer.nationality' => 'required|string',
            'customer.id_no' => 'required|numeric|digits:10',
            'customer.dob' => 'required|date|before:last year',
        ]);

        $user = User::where('mobile', $this->customer['mobile'])
            ->orWhere('id_no', $this->customer['id_no'])
            ->first();
        if ($user) {
            $user->update([
                'name' => $this->customer['name'],
                'nationality' => $this->customer['nationality'],
                'dob' => $this->customer['dob'],
            ]);
        } else {
            $user = User::create([
                'name' => $this->customer['name'],
                'mobile' => $this->customer['mobile'],
                'id_no' => $this->customer['id_no'],
                'nationality' => $this->customer['nationality'],
                'dob' => $this->customer['dob'],
            ]);
        }

        $order = [
            'order_number' => 'BEORD-' . date("ymhis", strtotime(now())),
            'user_id' => $user->id,
            'status' => 'pending',
            'grand_total' => collect($cart)->sum(static function ($item) {
                return $item['price'] * $item['quantity'];
            }),
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'unpaid',
            'notes' => null,
            'transaction_id' => null,
            'shipping_address' => null,
            'item_count' => count($cart),
        ];

        $order = Order::create($order);

        foreach ($cart as $item) {
            $order->products()->attach(
                $item['product_id'],
                [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'created_at' => now(),
                ]
            );
        }
        session()->forget('cart');
        session()->flash('success', 'Order placed successfully');
        $this->dispatch('order-created');
        return $this->redirect(route('checkout.success', $order->order_number));
    }

    public function render()
    {
        return view('livewire.guest.order.cart')
            ->layout('layouts.guest');
    }
}
