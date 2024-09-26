<?php

namespace App\Livewire\Dash\Products;

use AllowDynamicProperties;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $categories;
    public $brands;
    public $form = [];

    protected array $validationAttributes = [
        'form.name' => 'Product Name',
        'form.slug' => 'Product Slug',
        'form.price' => 'Price',
        'form.sale_price' => 'Sale Price',
        'form.quantity' => 'Stock Quantity',
        'form.thumbnail' => 'Product Thumbnail',
        'form.category' => 'Category',
        'form.brand' => 'Brand',
    ];
    protected $rules = [
        'form.name' => 'required',
        'form.slug' => 'nullable|unique:products,slug',
        'form.price' => 'required|numeric',
        'form.sale_price' => 'nullable|numeric',
        'form.quantity' => 'required|integer',
        'form.thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:1080',
        'form.category' => 'required| exists:categories,id',
        'form.brand' => 'required| exists:brands,id',
    ];

    public function mount()
    {
        $this->categories = Cache::flexible('categories', [5, 180], function () {
            return Category::active()->get();
        });

        $this->brands = Cache::flexible('brands', [5, 180], function () {
            return Brand::active()->get();
        });
    }


    public function store()
    {
        $this->validate();

        $this->form['slug'] = isset($this->form['slug']) ?
            Str::slug($this->form['slug']) :
            Str::slug($this->form['name']);

        $sku = $this->form['category'] . '-' . $this->form['brand'] . '-' . $this->form['slug'];

        $thumbnail = $this->form['thumbnail']->storeAs(
            'products',
            $this->form['slug'] . '.' . $this->form['thumbnail']->extension(),
            'public'
        );

        if ($thumbnail) {
            Storage::disk('local')->delete('livewire-tmp/' . $this->form['thumbnail']->getFilename());
        }

        $product = Product::create([
            'name' => $this->form['name'],
            'slug' => $this->form['slug'],
            'price' => $this->form['price'],
            'sale'=> (bool)$this->form['sale_price'],
            'sale_price' => $this->form['sale_price'] ?? null,
            'sku' => $sku,
            'quantity' => $this->form['quantity'],
            'thumbnail' => $thumbnail,
            'category_id' => $this->form['category'],
            'brand_id' => $this->form['brand'],

        ]);


        session()->flash('success', 'Product created successfully.');

        return $this->redirect(route('admin.product.update', $product->id), navigate: true);
    }


    public function render()
    {
        return view('livewire.dash.products.create', ['header' => 'Add New Product'])
            ->layout('layouts.app', ['title' => 'New Product']);
    }
}
