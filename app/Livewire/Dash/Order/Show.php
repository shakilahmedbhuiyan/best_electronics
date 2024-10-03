<?php

namespace App\Livewire\Dash\Order;

use App\Models\Order;
use Filament\Notifications\Notification;
use Livewire\Component;

class Show extends Component
{
    public $status;
    public $order;
    public function mount($order)
    {
        $data = Order::with('user', 'products')->find($order);
        //dd($data->toArray());
       return $this->order = $data;
    }

    public function updatedStatus()
    {

        $this->order->update(['status' => $this->status]);
        session()->flash('success', 'Order status updated successfully');
    }


    public function render()
    {
         if (session()->has('success')) {
            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->body(session('success'))
                ->color('success')
                ->iconColor('success')
                ->send();
            session()->forget('success');
        }
        return view('livewire.dash.order.show', ['header' => 'Order Details'])
            ->layout('layouts.app', ['title' => 'Order Details']);
    }
}
