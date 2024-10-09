<?php

namespace App\Livewire\Dash\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $name, $description, $status, $thumbnail, $slug, $image;
    public $category;

    public function mount($category)
    {
        $this->authorize('permission:category-update');
        $this->category = Category::findOrFail($category);
        $this->name = $this->category->name;
        $this->description = $this->category->description;
        $this->status = $this->category->status;
        $this->thumbnail = $this->category->thumbnail_url;
        $this->slug = $this->category->slug;
    }

    public function update()
    {

        $this->slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->name);
        $this->validate([
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:60|unique:brands,slug,' . $this->category->id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1080',
        ]);

        if ($this->image) {
            Storage::disk('public')->delete($this->category->thumbnail);
            $this->thumbnail = $this->image->storeAs(
                'categories',
                $this->slug . '.' . $this->image->extension(),
                'public'
            );
        }
        $this->category->update([
            'name' => $this->name,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'status' => $this->status,
            'slug' => $this->slug,
        ]);
        session()->flash('success', 'Category ' . $this->category->name . ' updated successfully');
        return redirect()->route('admin.category.index');
    }


    public function render()
    {
        return view('livewire.dash.category.update', ['header' => 'Update Category'])
            ->layout('layouts.app', ['title' => 'Update Category']);
    }
}
