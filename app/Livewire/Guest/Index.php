<?php

namespace App\Livewire\Guest;


use Artesaos\SEOTools\Traits\SEOTools;
use Filament\Notifications\Notification;
use Livewire\Component;

class Index extends Component
{
    use SEOTools;

    public function mount()
    {
        $store = app('store');
        $this->seo()->setTitle($store['description']);
        $this->seo()->opengraph()->setTitle($store['name']);
        $this->seo()->twitter()->setTitle($store['name']);
        $this->seo()->jsonLd()->setTitle($store['name']);
        $this->seo()->setCanonical( route('index') );
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

        return view('livewire.guest.index')
            ->layout('layouts.guest');
    }

}
