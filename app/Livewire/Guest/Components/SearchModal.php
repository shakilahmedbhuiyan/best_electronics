<?php

namespace App\Livewire\Guest\Components;

use Illuminate\Support\Str;
use Livewire\Component;

class SearchModal extends Component
{

    public $input;

    protected $validationAttributes = [
        'input' => 'search input'
    ];

    public function search()
    {
        $this->validate([
            'input' => 'required|string|min:3'
        ],
            [
                'input.required' => 'Please enter your search term',
                'input.min' => 'Please enter at least 3 characters'
            ]);
        return $this->redirect(route('products.search', Str::slug($this->input)), navigate: true);
    }

    public function render()
    {
        return view('livewire.guest.components.search-modal');
    }


}
