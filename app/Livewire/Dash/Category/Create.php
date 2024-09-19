<?php

namespace App\Livewire\Dash\Category;

use App\Models\Category;
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
            'slug' => 'required|string|max:60|unique:categories,slug',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $thumbnail = $this->thumbnail->storeAs(
            'categories',
            $this->slug . '.' . $this->thumbnail->extension(),
            'public'
        );



        $category = Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'thumbnail' => $thumbnail,
        ]);
         if ($thumbnail) {
            // Remove the temporary file by its path
            Storage::disk('local')->delete('livewire-tmp/' . $this->thumbnail->getFilename());
        }


        session()->flash('success', 'Category created successfully.');

        return $this->redirect(route('admin.category.index'), navigate: true);
    }


    public function render()
    {

        return view('livewire.dash.category.create', ['header' => 'Create Category'])
            ->layout('layouts.app', ['title' => 'Create Category']);
    }
}
