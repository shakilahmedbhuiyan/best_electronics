<?php

namespace App\Livewire\Guest\Product;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\Brand as BrandModel;
use Livewire\WithPagination;

class Brand extends Component
{
    use WithPagination;

    private $slug;
    public $brand;
    private $key;
    private $page = 1;

    public function mount($brand)
    {
        $this->slug = $brand;
        $this->brand = Cache::rememberForever("brand_" . $brand, function () {
            return BrandModel::where('slug', $this->slug)
                ->orWhere('name', 'like', '%' . $this->slug . '%')
                ->active()
                ->first();
        });

        if (!$this->brand) {
            $brands = BrandModel::active()->get();

            $closestBrand = $brands->sortBy(function ($brand) {
                return levenshtein(strtolower($brand->slug), strtolower($this->slug));
            })->first();

            if (levenshtein(strtolower($closestBrand->slug), strtolower($this->slug)) <= 3) {
                $this->brand = $closestBrand;
            } else {
                abort(404); // No close match found
            }
        }
        $this->key = "brand-" . $this->slug . "-products-page-" . $this->page;
    }

    public function gotoPage($page, $pageName = 'page')
    {
        $this->page = $page;
        $this->setPage($page, $pageName);
        $this->key = "brand-" . $this->slug . "-products-page-" . $page;
    }

    public function render()
    {
        if (cache()->has($this->key)) {
            $products = cache()->get($this->key);
        } else {
            $products = $this->brand->products()->paginate(12);
            Cache::forever($this->key, $products);
        }
        return view('livewire.guest.product.brand', compact('products'))
            ->layout('layouts.guest');
    }
}
