<?php

namespace App\Livewire\Dash\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $order;
    public function mount($order)
    {
        $data = Order::with('user', 'products')->find($order);
        //dd($data->toArray());
       return $this->order = $data;
    }

    public function render()
    {
        return view('livewire.dash.order.show', ['header' => 'Order Details'])
            ->layout('layouts.app', ['title' => 'Order Details']);
    }
}
