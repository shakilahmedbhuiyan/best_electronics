<?php

namespace App\Livewire\Guest\Components;

use Livewire\Component;

class SearchModal extends Component
{

    public $search;

    public function updatedSearch()
    {
        $this->search = null;
    }

    public function render()
    {
        return view('livewire.guest.components.search-modal');
    }


}
