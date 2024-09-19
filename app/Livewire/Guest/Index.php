<?php

namespace App\Livewire\Guest;

use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class Index extends Component
{
    use SEOTools;

    public function render()
    {

        $this->seo()->setTitle('Affordable Printing Solutions');
        $this->seo()
            ->setDescription('One-Stop Print Solution. All types of printing services are available in one location. We guarantee high-quality printing for all of your printing needs.');
        $this->seo()->opengraph()->setUrl('https://printnsign.co.uk');


        return view('livewire.guest.index')
            ->layout('layouts.guest');
    }

    public function category($category)
    {
        $this->seo()->setTitle('Affordable Printing Solutions');
        $this->seo()
            ->setDescription('One-Stop Print Solution. All types of printing services are available in one location. We guarantee high-quality printing for all of your printing needs.');
        $this->seo()->opengraph()->setUrl('https://printnsign.co.uk');
        return view('livewire.guest.category', compact('category'));
    }
}
