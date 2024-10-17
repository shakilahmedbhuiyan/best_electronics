<?php

namespace App\Livewire\Guest\Product;

use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\Brand as BrandModel;
use Livewire\WithPagination;

class Brand extends Component
{
    use WithPagination;
    use SEOTools;

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
        $title = $this->brand->name . ' Products';
        $description = $this->brand->description;

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->openGraph()
            ->setTitle($title)
            ->setDescription($description)
            ->setUrl(route('index.brand', $this->brand->slug))
            ->addImage( $this->brand->thumbnail_url);
        $this->seo()->setTitle($title);
        $this->seo()->addImages($this->brand->thumbnail_url);

        if (cache()->has($this->key)) {
            $products = cache()->get($this->key);
        } else {
            $products = Cache::flexible($this->key, [5, now()->addDays(5)], function () {
                return Product::with('brand', 'category')
                    ->where('brand_id', $this->brand->id)
                    ->Active()
                    ->InStock()
                    ->paginate(12);
            });
        }
        return view('livewire.guest.product.brand', compact('products'))
            ->layout('layouts.guest');
    }
}
