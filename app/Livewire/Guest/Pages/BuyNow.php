<?php

namespace App\Livewire\Guest\Pages;

use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class BuyNow extends Component
{
    use SEOTools;
     public function  mount()
    {
        $this->seo()->setTitle('Buy Now Pay Later');
        $this->seo()->setDescription('Buy now and pay later with our flexible payment options. We offer up to 36 months of installment to suit your needs');
        $this->seo()->addImages(asset('assets/img/pay-later.png'));
        $this->seo()->setCanonical( route('pay-later'));
    }
    public function render()
    {
        return view('livewire.guest.pages.buy-now')
            ->layout('layouts.guest');
    }
}
