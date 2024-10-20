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
    private $page = 1;

    public function mount()
    {
        $this->key = "products-page-" . $this->page;
    }

    public function gotoPage($page, $pageName = 'page')
    {
        $this->page = $page;
        $this->setPage($page, $pageName);
        $this->key = "products-page-" . $page;
    }


    public function render()
    {
        if (cache()->has($this->key)) {
            $products = cache()->get($this->key);
        } else {
            $products = Product::with('brand')
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->orderBy('price', 'desc')
                ->paginate(12);
            Cache::flexible($this->key, [300, now()->addDays(5)], function () use ($products) {
                return $products;
            });

        }
        return view('livewire.guest.components.product-collection', compact('products'));
    }

}
