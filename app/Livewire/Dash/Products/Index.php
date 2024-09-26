<?php

namespace App\Livewire\Dash\Products;

use App\Models\Product;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class Index extends Component
{
    use WireUiActions, WithPagination;

    public $product;
    public $search = "";
    public $cache = true;
     public int | string $perPage = 15;


//    public function updateSearch()
//    {
////        dd($this->search);
//        $this->SearchProducts();
//        $this->dispatch('$refresh');
//    }

    public function SearchProducts()
    {
        $cacheKey = 'product-page-' . request('page', 1);

//        return Cache::flexible($cacheKey, [5,100], function () {
//            $this->cache=false;
            return Product::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%')
                ->orWhereHas('category', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('brand', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->with('category', 'brand')
                ->simplePaginate($this->perPage);
//        });
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

        return view('livewire.dash.products.index',
            ['header' => ' Products'],
            ['products'=>$this->SearchProducts()])
            ->layout('layouts.app', ['title' => 'Products Index']);
    }
}
