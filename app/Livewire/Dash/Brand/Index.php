<?php

namespace App\Livewire\Dash\Brand;

use App\Models\Brand;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Index extends Component
{
    use WireUiActions;

    protected $listeners =['refresh' => '$refresh'];

    public $brands;

    public function mount()
    {
       $this->brands= Brand::all();

    }


    public function featured($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update(['featured' => !$brand->featured]);
        $this->dispatch('$refresh');
        $this->mount();
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Updated successfully',
            'description' => 'Brand '.$brand->name .' updated successfully',
        ]);
    }

    public function render()
    {
        if (session()->has('success')) {
            $this->notification()->send([
                'icon' => 'success',
                'title' => 'Saved successfully',
                'description' => session('success'),
            ]);
        }

        return view('livewire.dash.brand.index', ['header' => 'Brands'])
            ->layout('layouts.app', ['title' => 'Brands']);
    }
}
