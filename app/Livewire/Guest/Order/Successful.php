<?php

namespace App\Livewire\Guest\Order;

use App\Models\Order;
use Artesaos\SEOTools\Traits\SEOTools;
use Filament\Notifications\Notification;
use Livewire\Component;

class Successful extends Component
{
    use SEOTools;

    public  $order;
    public function mount($order)
    {
        $this->seo()->setTitle('Order Successful');
        $this->seo()->setDescription('Order has been placed successfully');
        $data = Order::with('user', 'products')
            ->where('order_number', $order)->first();
        $this->order=$data;
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
        return view('livewire.guest.order.successful')
            ->layout('layouts.guest');
    }
}
