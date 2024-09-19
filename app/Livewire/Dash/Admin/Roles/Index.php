<?php

namespace App\Livewire\Dash\Admin\Roles;

use Livewire\Component;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Spatie\Permission\Models\Permission;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Split;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use WireUi\Traits\WireUiActions;

class Index extends Component implements HasForms, HasTable
{
    use WireUiActions;
    use InteractsWithTable;
    use InteractsWithForms;

    public $roles;

    protected $listeners =
        [
            'refresh' => '$refresh',
        ];
    public $up = false;


    public function mount()
    {
        $this->roles = Role::get();
    }


    public function delete(Role $role)
    {
        $this->authorize('delete', $role);
        $role->permissions()->detach();
        $role->delete();
        $this->dispatch('refresh');
        $this->notification()->success(
            $title = 'Role ' . $role->name . ' Deleted',
            $description = 'Role deleted successfully'
        );
    }

    public function table(Table $table): Table
    {

        return $table
            ->query(Permission::query())
            ->columns([

                Split::make([
                    TextColumn::make('name')
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('guard_name')
                        ->label('Guard')
                        ->searchable()
                        ->sortable(),

                    TextColumn::make('created_at')
                        ->dateTime('d M, Y h:i:sa'),

                    TextColumn::make('updated_at')
                        ->label('Last Update')
                        ->dateTime('d M, Y h:i:sa')
                ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Permission')
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(20)
                            ->placeholder('Permission Name')
                            ->rules([
                                'required',
                                'max:20',
                                'unique:permissions,name'
                            ])
                    ])
                    ->extraAttributes(['class' => 'text-blue-500'])
            ])
            ->actions([
                EditAction::make()
                    ->authorize('update', Permission::class)
                    ->form(function (Permission $record) {
                        return [
                            TextInput::make('name')
                                ->default($record->name)
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Permission Name')
                                ->rules([
                                    'required',
                                    'max:20',
                                    'unique:permissions,name, ' . $record->id
                                ]),
                            TextInput::make('guard_name')
                                ->default($record->guard_name)
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Guard Name')
                                ->rules([
                                    'required',
                                    'max:20',
                                ])
                        ];
                    })
                    ->extraAttributes(['class' => 'text-amber-500'])

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
        return view('livewire.dash.admin.roles.index', ['header' => 'Roles and Permissions'])
            ->layout('layouts.app', ['title' => 'Roles']);
    }
}
