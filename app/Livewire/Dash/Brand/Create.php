<?php

namespace App\Livewire\Dash\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name, $slug, $description, $status, $thumbnail;


    public function store()
    {
        $this->slug = $this->slug ? Str::slug($this->slug) : Str::slug($this->name);
        $validated = $this->validate([
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:60|unique:brands,slug',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $thumbnail = $this->thumbnail->storeAs(
            'brands',
            $this->slug . '.' . $this->thumbnail->extension(),
            'public'
        );

        $category = Brand::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'thumbnail' => $thumbnail,
        ]);
        if ($this->thumbnail) {
            // Remove the temporary file by its path
            Storage::disk('local')->delete('livewire-tmp/' . $this->thumbnail->getFilename());
        }
        Cache::forever('brands', Brand::where('status', true)->get());
        session()->flash('success', 'Brand created successfully.');

        return $this->redirect(route('admin.brand.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.dash.brand.create', ['header' => 'Create Brand'])
            ->layout('layouts.app', ['title' => 'Create Brand']);
    }
}
