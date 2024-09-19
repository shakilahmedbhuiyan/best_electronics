<?php

namespace App\Livewire\Dash\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $categories;
    public $brands;
    public $form = [];

    protected array $validationAttributes= [
        'form.name' => 'Product Name',
        'form.slug' => 'Product Slug',
        'form.price' => 'Price',
        'form.quantity' => 'Stock Quantity',
        'form.thumbnail' => 'Product Thumbnail',
        'form.category' => 'Category',
        'form.brand' => 'Brand',
    ];

    public function mount()
    {
        $this->categories = Cache::flexible('categories', [5, 300], function () {
            return Category::where('status', true)->get();
        });

        $this->brands = Cache::flexible('brands', [5, 300], function () {
            return Brand::where('status', true)->get();
        });

    }

    public function store()
    {
        $validated = $this->validate([
            'form.name' => 'required',
            'form.slug' => 'required',
            'form.price' => 'required|numeric',
            'form.sale_price' => 'nullable|numeric',
            'form.quantity' => 'required|integer',
            'form.thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1080',
            'form.category' => 'required| exists:categories,id',
            'form.brand' => 'required| exists:brands,id',

        ]);

//        Product::create([
//            'name' => $this->name,
//            'slug' => Str::slug($this->name),
//            'summary' => $this->summary,
//            'description' => $this->description,
//            'sku' => $this->sku,
//            'price' => $this->price,
//            'quantity' => $this->quantity,
//            'thumbnail' => $this->thumbnail,
//            'category_id' => $this->category_id,
//            'brand_id' => $this->brand_id,
//            'meta_title' => $this->meta_title,
//            'meta_description' => $this->meta_description,
//            'meta_keywords' => $this->meta_keywords,
//        ]);

        session()->flash('success', 'Product created successfully.');

        return redirect()->route('admin.product.index');
    }


    public function render()
    {
        return view('livewire.dash.products.create', ['header' => 'Add New Product'])
            ->layout('layouts.app', ['title' => 'New Product']);
    }
}
