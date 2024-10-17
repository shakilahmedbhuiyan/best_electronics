<?php

namespace App\Livewire\Dash\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $name, $description, $status, $thumbnail, $slug, $image, $featured;
    public $brand;
    public function mount($brand)
    {
        $this->authorize('permission:brand-update');
        $brand = Brand::findOrFail($brand);
        $this->brand = $brand;
        $this->name = $brand->name;
        $this->description =   $brand->description;
        $this->status = $brand->status;
        $this->thumbnail = $brand->thumbnail_url;
        $this->slug = $brand->slug;
        $this->featured = $brand->featured;
    }

    public function update()
    {

        $this->slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->name);
        $this->validate([
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:60|unique:brands,slug,' . $this->brand->id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1080',
        ]);

        if ($this->image) {
            Storage::disk('public')->delete($this->brand->thumbnail);
            $this->thumbnail = $this->image->storeAs(
                'brands',
                $this->slug . '.' . $this->image->extension(),
                'public'
            );
        }
        $this->brand->update([
            'name' => $this->name,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'status' => $this->status,
            'featured' => $this->status? $this->featured : 0,
            'slug' => $this->slug,
        ]);
        session()->flash('success', 'Brand '.$this->brand->name.' updated successfully');
        return redirect()->route('admin.brand.index');
    }


    public function render()
    {
        return view('livewire.dash.brand.update', ['header' => 'Update Brand'])
            ->layout('layouts.app', ['title' => 'Update Brand']);
    }
}
