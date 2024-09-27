<?php

namespace App\Livewire\Dash\Brand;

use App\Models\Brand;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
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


    public function mount()
    {
//       $brands= Brand::all();
//         dd($brands);
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(Brand::query())
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
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('featured')
                    ->label('Featured')
                    ->options([
                        '1' => 'Featured',
                        '0' => 'Unfeatured',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
            ])
            ->actions([
                Action::make('feature')
                    ->action(function (Brand $record) {
                        $record->featured = true;
                        $record->save();
                    })
                    ->hidden(fn(Brand $record): bool => $record->featured),
                Action::make('unfeature')
                    ->action(function (Brand $record) {
                        $record->featured = false;
                        $record->save();
                    })
                    ->visible(fn(Brand $record): bool => $record->featured),
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
        return view('livewire.dash.brand.index', ['header' => 'Brands'])
            ->layout('layouts.app', ['title' => 'Brands']);
    }
}
