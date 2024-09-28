<?php

namespace App\Livewire\Dash\Store;

use App\Models\store;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Info extends Component
{
    use WithFileUploads;

    public ?array $store = [];
    public $logo, $logo2;
    public ?array $seo = [];
    public ?array $social = [];


    public function mount()
    {
        $info = Store::first();
        if ($info !== null) {
            if ($info->company !== null) {
                $this->store = $info->company;
                $this->logo = $info->logo?? null;
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
            'store.website' => 'required|string',
            'store.map_link' => 'required|url',
        ]);

        $store = Store::updateOrCreate([
            'id' => '1',
        ], $this->store);

        $this->store = $store->toArray();
        Cache::delete('store-info');
        Cache::forever('store-info', $this->store);
        session()->flash('success', 'Store Info Updated Successfully');
    }

    public function updateLogo()
    {
        $this->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1100',
        ]);

        if (file_exists(public_path('logo.'.$this->logo->extension()))) {
            unlink(public_path('logo.'.$this->logo->extension()));
        }
        $logo=$this->logo->storeAs('logo','logo.'.$this->logo->extension(), 'public');
        Storage::disk('local')->delete('livewire-tmp/' . $this->logo->getFilename());

        $storeLogo = Store::findOrFail(1);
        $storeLogo->logo = $logo;
        $storeLogo->save();
        $this->logo = $storeLogo->logo;
        Cache::delete('store-info');
        Cache::forever('store-info', $storeLogo);
        session()->flash('success', 'Store Logo Updated Successfully');
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
