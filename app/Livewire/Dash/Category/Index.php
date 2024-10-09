<?php

namespace App\Livewire\Dash\Category;

use App\Models\Category;
use Filament\Notifications\Notification;
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
        $this->search();
    }

     private function search()
    {
        return Category::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->orWhere('featured', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
    }

    public function featured($id)
    {
        $cat = Category::findOrFail($id);
        $cat->update(['featured' => !$cat->featured]);
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Updated successfully',
            'description' =>  $cat->name . ' category updated successfully',
        ]);
        $this->dispatch('$refresh');
    }

    public function render()
    {
        if (session()->has('success')) {
            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->body(session('success'))
                ->color('success')
                ->iconColor('success')
                ->send();
            session()->forget('success');
        }
        return view('livewire.dash.category.index',
            ['header' => 'Categories'],
            ['categories' => $this->search()]
        )
            ->layout('layouts.app', ['title' => 'Categories']);
    }
}
