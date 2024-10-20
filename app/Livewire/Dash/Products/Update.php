<?php

namespace App\Livewire\Dash\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use WireUi\Traits\WireUiActions;

class Update extends Component
{
    use withFileUploads, WireUiActions;

    public $product;
    public $categories;
    public $brands;
    public $form = [];


    protected array $validationAttributes = [
        'form.name' => 'Product Name',
        'form.slug' => 'Product Slug',
        'form.price' => 'Price',
        'form.sale_price' => 'Sale Price',
        'form.instalment' => 'Instalment',
        'form.quantity' => 'Stock Quantity',
        'form.thumbnail' => 'Product Thumbnail',
        'form.category_id' => 'Category',
        'form.brand_id' => 'Brand',
        'form.description' => 'Description',
        'form.summary' => 'Summary',
        'form.status' => 'Status',
        'form.meta_title' => 'SEO Title',
        'form.meta_description' => 'SEO Description',
        'form.meta_keywords' => 'SEO Keywords',
    ];

    #[on('productImage')]
    public function successNotification()
    {
        $this->dispatch('$refresh');
        $this->mount($this->product->id);
    }

    public function mount($product)
    {
        $this->product = Product::with('images')
            ->findOrFail($product);
        $this->form = $this->product->toArray();
        $this->form['category'] = $this->product->category->id;
        $this->form['brand'] = $this->product->brand->id;
        $this->form['thumbnail'] = null;

        $this->categories = Cache::flexible('categories', [5, 180], function () {
            return Category::active()->get();
        });

        $this->brands = Cache::flexible('brands', [5, 180], function () {
            return Brand::active()->get();
        });
    }

    public function store()
    {
        $this->validate([
            'form.name' => 'required',
            'form.slug' => 'required|unique:products,slug, ' . $this->product->id,
            'form.price' => 'required|numeric',
            'form.sale_price' => 'nullable|numeric',
            'form.quantity' => 'required|integer',
            'form.thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1080',
            'form.category_id' => 'required| exists:categories,id',
            'form.brand_id' => 'required| exists:brands,id',
            'form.description' => 'nullable|string',
            'form.summary' => 'required|string',
            'form.status' => 'required|boolean',
            'form.instalment' => 'required|boolean',
            'form.meta_title' => 'nullable|string',
            'form.meta_description' => 'nullable|string',
            'form.meta_keywords' => 'nullable|string',
        ]);

        $thumbnail = $this->product->thumbnail;

        if ($this->form['thumbnail']) {
            Storage::disk('local')->delete($this->product->thumbnail);
            $thumbnail = $this->form['thumbnail']->storeAs(
                'products',
                $this->form['slug'] . '.' . $this->form['thumbnail']->extension(),
                'public'
            );
            Storage::disk('local')->delete('livewire-tmp/' . $this->form['thumbnail']->getFilename());
        }
        $this->product->update([
            'name' => $this->form['name'],
            'slug' => $this->form['slug'],
            'price' => $this->form['price'],
            'sale' => (bool)$this->form['sale_price'],
            'sale_price' => $this->form['sale_price'] ?? null,
            'quantity' => $this->form['quantity'],
            'thumbnail' => $thumbnail,
            'description' => $this->form['description'],
            'summary' => $this->form['summary'],
            'is_featured' => (bool)$this->form['is_featured'],
            'category_id' => $this->form['category_id'],
            'brand_id' => $this->form['brand_id'],
            'status' => $this->form['status'],
            'instalment' => $this->form['instalment'],
            'meta_title' => $this->form['meta_title'] ?? $this->form['name'],
            'meta_description' => $this->form['meta_description'] ?? $this->form['summary'],
            'meta_keywords' => $this->form['meta_keywords'] ?? $this->form['name'],
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Product Updated successfully');
        return $this->redirect(route('admin.product.index'), navigate: true);
    }

    public function deleteImage($id)
    {
        $image=ProductGallery::find($id);
        if (Storage::disk('public')->exists($image->image))
        {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();
        $this->dispatch('$refresh');
        $this->dispatch('productImage');
    }

    public function render()
    {
        if (session()->has('success')) {
            Notification::make()
                ->title('Product Created successfully')
                ->success()
                ->body(session('success'))
                ->color('success')
                ->iconColor('success')
                ->send();
            session()->forget('success');
        }
        return view('livewire.dash.products.update', ['header' => 'Update Product'])
            ->layout('layouts.app', ['title' => 'Update Product']);
    }
}
