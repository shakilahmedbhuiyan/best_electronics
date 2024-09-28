<?php

namespace App\Livewire\Dash\Store;

use App\Models\store;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Info extends Component
{
    public ?array $store = [];
    public ?array $seo = [];
    public ?array $social = [];


    public function mount()
    {
        $info = Store::first();
        if ($info !== null) {
            if ($info->company !== null) {
                $this->store = $info->company;
            }
            if ($info->seo !== null) {
                $this->seo = $info->seo;
            }
            if ($info->social !== null) {
                $this->social = $info->social;
            }
        }
    }

    public function updateStore()
    {
        $this->validate([
            'store.name' => 'required|string',
            'store.description' => 'required|string',
            'store.address' => 'required|string',
            'store.phone' => 'required|string',
            'store.email' => 'required|email',
            'store.website' => 'required|url',
            'store.map_link' => 'required|url',
        ]);

        $store = Store::updateOrCreate([
            'id' => '1',
        ], [
            'company' => $this->store,
        ]);

        $this->store = $store->toArray();
        Cache::forever('store-info', $store);
        session()->flash('success', 'Store Info Updated Successfully');
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
        return view('livewire.dash.store.info', ['header' => 'Store Info'])
            ->layout('layouts.app', ['title' => 'Store Info']);
    }
}
