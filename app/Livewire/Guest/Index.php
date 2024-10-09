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
        $description = 'Best Electronics offers all kinds of Smartphones with Installment facility all over Saudi Arabia. Choose your best device and gadget';
        $store = app('store');
        $this->seo()->setTitle('Best Mobile Shop in KSA');
        $this->seo()->opengraph()->addImage(asset('assets/img/pay-later.png'));
        $this->seo()->metatags()->setKeywords(['Mobile Shop', 'iphone 16', 'Mobile Phones', 'Mobile Accessories']);
        $this->seo()->opengraph()->setTitle('Best Mobile Shop in KSA');
        $this->seo()->twitter()->setTitle($store['name']);
        $this->seo()->jsonLd()->setTitle('Best Mobile Shop in KSA- '.$store['name']);
        $this->seo()->setDescription('Best Mobile Shop in KSA- '.$description);
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
