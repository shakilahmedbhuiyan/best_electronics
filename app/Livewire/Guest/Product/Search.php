<?php

namespace App\Livewire\Guest\Product;

use AllowDynamicProperties;
use App\Models\Product;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

#[AllowDynamicProperties] class Search extends Component
{
    use WithPagination, SEOTools;

    private $search;

    public function mount($search)
    {
        $this->search = $search;

        $this->title = 'Product Search';
        $this->description = "The product you search for {$search}.
        Searched products founds on our store are displayed below.";

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
        $query = explode('-', $this->search);

        $key = 'product_search_' . $this->search;
        if (Cache::has($key)) {
            $products = Cache::get($key);
        } else {
            $products = Product::where(function ($q) use ($query) {
                foreach ($query as $item) {
                    $q->orWhere('name', 'like', '%' . $item . '%');
                }
            })
                ->where('status', true)
                ->where('quantity', '>', 0)
                ->with('brand', 'category');
            if ($products === null || $products->count() === 0) {
                abort(404);
            }
            $products = $products->paginate(12);
            Cache::rememberForever($key, function () use ($products) {
                return $products;
            });
        }
        return view('livewire.guest.product.search', compact('products'))
            ->layout('layouts.guest');
    }
}
