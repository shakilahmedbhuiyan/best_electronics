<?php

namespace App\Livewire\Guest\Product;

use AllowDynamicProperties;
use Artesaos\SEOTools\Traits\SEOTools;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithPagination;

#[AllowDynamicProperties] class Index extends Component
{
    use withPagination, SEOTools;

    public function  mount()
    {
        $this->title = 'All Products';
        $this->description = config('seotools.meta.defaults.description');

        $this->seo()->openGraph()
            ->setTitle($this->title)
            ->setDescription($this->description)
            ->setUrl(route('products.all'))
            ->addImage(asset('assets/img/buy-now.png'));
        $this->seo()->setTitle($this->title);
        $this->seo()->addImages(asset('assets/img/buy-now.png'));
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
        return view('livewire.guest.product.index')
            ->layout('layouts.guest');
    }
}
