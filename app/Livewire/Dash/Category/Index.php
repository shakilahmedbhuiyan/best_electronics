<?php

namespace App\Livewire\Dash\Category;

use App\Models\Category;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class Index extends Component implements HasForms, HasTable
{
    use WireUiActions, InteractsWithTable;
    use InteractsWithForms;




     public function table(Table $table): Table
    {
        return $table
            ->query(Category::query())
            ->columns([
                Split::make([
                    ImageColumn::make('thumbnail_url')
                        ->disk('public')
                        ->circular()
                        ->grow(false),
                    TextColumn::make('name')
                        ->label('Name')
                        ->searchable()
                        ->sortable(),
                    IconColumn::make('featured')
                        ->sortable()
                        ->boolean(),
                ]),

            ])
            ->actions([
                Action::make('feature')
                    ->action(function (Category $record) {
                        $record->featured = true;
                        $record->save();
                    })
                    ->hidden(fn(Category $record): bool => $record->featured),
                Action::make('unfeature')
                    ->action(function (Category $record) {
                        $record->featured = false;
                        $record->save();
                    })
                    ->visible(fn(Category $record): bool => $record->featured),
            ])
            ->filters([
                Filter::make('featured')
                    ->label('Featured')
            ]);
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
        return view('livewire.dash.category.index', ['header' => 'Categories'])
            ->layout('layouts.app' , ['title' => 'Categories']);
    }
}
