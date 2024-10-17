<?php

namespace App\Livewire\Guest\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Related extends Component
{
    public $products = [];

    public function mount($productId, $categoryId, $brandId)
    {
        $this->products = Cache::flexible('related-products-' . $productId, [1500, now()->addDays(5)],
            function () use ($productId, $categoryId, $brandId) {
                return $this->getRelatedProducts($productId, $categoryId, $brandId);
            });
    }

    public function getRelatedProducts($productId, $categoryId, $brandId)
    {
        return Product::where(function ($query) use ($categoryId, $brandId) {
            $query->where('category_id', $categoryId)
                ->orWhere('brand_id', $brandId);
        })
            ->where('id', '!=', $productId)
            ->where('status', true)
            ->where('quantity', '>', 0)
            ->take(5)
            ->with('brand', 'category')
            ->get();
    }

    public function render()
    {
        return view('livewire.guest.product.related');
    }
}
