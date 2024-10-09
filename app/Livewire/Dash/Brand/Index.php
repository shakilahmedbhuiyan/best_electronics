<?php

namespace App\Livewire\Dash\Brand;

use AllowDynamicProperties;
use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class Index extends Component
{
    use WireUiActions, WithPagination;

    public $search = '';
    public $perPage = 15;
    protected $listeners = ['refresh' => '$refresh'];

    public function updatingSearch()
    {
        $this->searchBrands();
    }
    private function searchBrands()
    {
        return Brand::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->orWhere('featured', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
    }

    public function featured($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update(['featured' => !$brand->featured]);
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Updated successfully',
            'description' => 'Brand ' . $brand->name . ' updated successfully',
        ]);
        $this->dispatch('$refresh');
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
        return view('livewire.dash.brand.index',
            ['header' => 'Brands'],
            ['brands' => $this->searchBrands()])
            ->layout('layouts.app', ['title' => 'Brands']);
    }
}
