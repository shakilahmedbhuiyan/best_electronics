<?php

namespace App\Livewire\Dash\Category;

use Filament\Notifications\Notification;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Index extends Component
{
    use WireUiActions;

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
        return view('livewire.dash.category.index', ['header' => 'Categories'])
            ->layout('layouts.app' , ['title' => 'Categories']);
    }
}
