<?php

namespace App\Livewire\Guest\Components;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCollection extends Component
{
    use WithPagination;

    private $key;

    public function mount()
    {
        $this->key = 'products-collection-page-1';
    }


    public function render()
    {

        if (cache()->has($this->key)) {
            $products = cache()->get($this->key);
        } else {
            $products = Product::active()
                ->inStock()
                ->with('category', 'brand')
                ->orderBy('price')
                ->paginate(12);
            $key = 'products-collection-page-' . $products->currentPage();
            Cache::forever($key, $products);
        }


        return view('livewire.guest.components.product-collection', compact('products'));


    }
}
