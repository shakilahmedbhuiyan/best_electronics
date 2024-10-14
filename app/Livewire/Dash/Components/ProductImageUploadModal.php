<?php

namespace App\Livewire\Dash\Components;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\WireUiActions;

class ProductImageUploadModal extends Component
{
    use WithFileUploads;
    use WireUiActions;

    public $image;
    public $variation;

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function save()
    {

        $validated = $this->validate([
            'image' => 'required|image|max:1024',
            'variation' => 'required|string|max:100'
        ]);
        $slug = $this->product->slug.'-'.Str::slug($this->variation);
        if ($this->product->images()->where('variation', $slug)->exists()) {
            $this->addError('variation', 'Variation already exists');
            return;
        }
        $image= $this->image->storeAs(
            'products-gallery',
            $slug.'.'.$this->image->extension(),
            'public');
        $this->product->images()->create([
            'image' => $image,
            'variation' => $this->variation
        ]);
        Storage::disk('local')->delete('livewire-tmp/' . $this->image->getFilename());

        $this->dispatch('productImage');
        $this->image = null;
        $this->variation = null;
    }

    #[on('productImage')]
    public function successNotification()
    {
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Product Image Added',
            'description' => 'Product image has been added successfully',
        ]);
        $this->dispatch('close');
    }

    public function cancel()
    {
        if ($this->image) {
            Storage::disk('local')->delete('livewire-tmp/' . $this->image->getFilename());
        }
        $this->image = null;
        $this->variation = null;
        $this->dispatch('close');
    }

    public function render()
    {
        return view('livewire.dash.components.product-image-upload-modal');
    }
}
