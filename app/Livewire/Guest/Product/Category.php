<?php

namespace App\Livewire\Guest\Product;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Models\Category as CategoryModel;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    private $slug;
    public $category;
    private $key;
    private $page = 1;

    public function mount($category)
    {
        $this->slug = $category;
        $this->category = Cache::rememberForever("category_" . $category, function () {
            return CategoryModel::where('slug', $this->slug)
                ->orWhere('name', 'like', '%' . $this->slug . '%')
                ->active()
                ->first();
        });

        if (!$this->category) {
            $categories = CategoryModel::active()->get();

            $closestCategory = $categories->sortBy(function ($category) {
                return levenshtein(strtolower($category->slug), strtolower($this->slug));
            })->first();

            if (levenshtein(strtolower($closestCategory->slug), strtolower($this->slug)) <= 3) {
                $this->category = $closestCategory;
            } else {
                abort(404); // No close match found
            }
        }
        $this->key = "category-" . $this->slug . "-products-page-" . $this->page;
    }

    public function gotoPage($page, $pageName = 'page')
    {
        $this->page = $page;
        $this->setPage($page, $pageName);
        $this->key = "category-" . $this->slug . "-products-page-" . $page;
    }

    public function render()
    {
        if (cache()->has($this->key)) {
            $products = cache()->get($this->key);
        } else {
            $products = $this->category->products()->paginate(12);
            Cache::forever($this->key, $products);
        }
        return view('livewire.guest.product.category', compact('products'))
            ->layout('layouts.guest');
    }
}
