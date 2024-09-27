<?php

namespace App\Livewire\Dash\Home\Slider;

use App\Models\HomeSlider;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use WireUi\Traits\WireUiActions;

class Index extends Component implements HasForms, HasTable
{
    use WireUiActions, InteractsWithTable;
    use InteractsWithForms;

    public function mount()
    {
//        $sliders= HomeSlider::all();
//        dd($sliders->image_url);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(HomeSlider::query())
            ->columns([
                Split::make([
                    ImageColumn::make('thumbnail_url')
                        ->disk('public')
                        ->width(200)
                        ->height(100)
                        ->grow(false),
                    TextColumn::make('title')
                        ->label('Title')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('link')
                        ->label('Link')
                        ->searchable()
                        ->sortable(),
                    IconColumn::make('status')
                        ->sortable()
                        ->boolean(),
                ]),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
            ])
            ->actions([
                EditAction::make()
                    ->form(function (HomeSlider $record) {
                        return [
                            TextInput::make('title')
                                ->default($record->name)
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Slider Name')
                                ->rules([
                                    'required',
                                    'max:100',
                                ]),
                            TextInput::make('link')
                                ->default($record->link)
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Slider Link')
                                ->rules([
                                    'required',
                                    'string',
                                ]),
                            Toggle::make('status')
                                ->default($record->status)
                                ->required()
                                ->rules([
                                    'required',
                                    'boolean',
                                ])
                        ];
                    })
                    ->extraAttributes(['class' => 'text-amber-500']),
                DeleteAction::make()
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (HomeSlider $record) {
                        if (Storage::disk('public')->exists($record->image)) {
                            Storage::disk('public')->delete($record->image);
                        }
                        $record->delete();
                    })
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

        return view('livewire.dash.home.slider.index', ['header' => 'Home Slider'])
            ->layout('layouts.app', ['title' => 'Sliders']);
    }
}
