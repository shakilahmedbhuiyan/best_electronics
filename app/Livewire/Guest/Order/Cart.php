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
        'customer.email' => 'email',
        'customer.mobile' => 'mobile',
        'customer.address' => 'address',
        'customer.city' => 'city',
        'customer.id_no' => 'Identity Number',
        'customer.nationality' => 'nationality',
    ];

    public ?array $customers = [];
    public ?array $customer = [];

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
            'customer.email' => 'required|email',
            'customer.mobile' => 'required|int|digits:15',
            'customer.address' => 'required|string',
            'customer.city' => 'required|string',
            'customer.nationality' => 'required|string',
            'customer.id_no' => 'required|string',
        ]);

        $user = User::where('email', $this->customer['email'])
            ->orWhere('mobile', $this->customer['mobile'])
            ->orWhere('id_no', $this->customer['id_no'])
            ->first();
        if ($user) {
            $user->update([
                'name' => $this->customer['name'],
                'address' => $this->customer['address'],
                'city' => $this->customer['city'],
                'nationality' => $this->customer['nationality'],
            ]);
        } else {
            $user = User::create([
                'name' => $this->customer['name'],
                'email' => $this->customer['email'],
                'mobile' => $this->customer['mobile'],
                'id_no' => $this->customer['id_no'],
                'address' => $this->customer['address'],
                'city' => $this->customer['city'],
                'nationality' => $this->customer['nationality'],
            ]);
        }

        $order = [
            'order_number' => 'BEKSA-' . strtoupper(uniqid('ORD', false)),
            'user_id' => $user->id,
            'status' => 'pending',
            'grand_total' => collect($cart)->sum(static function ($item) {
                return $item['price'] * $item['quantity'];
            }),
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'unpaid',
            'notes' => null,
            'transaction_id' => null,
            'shipping_address' => $this->customer['address'],
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
        return $this->redirect(route('checkout.success', $order->order_number));
    }


    public function render()
    {
        return view('livewire.guest.order.cart')
            ->layout('layouts.guest');
    }
}
