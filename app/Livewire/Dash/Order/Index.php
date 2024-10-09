<?php

namespace App\Livewire\Dash\Order;

use App\Models\Order;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Index extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::where('status', '!=', 'pending')
                    ->with('user', 'products')
                    ->orderBy('created_at', 'desc')
            )
            ->columns([
//                Split::make([
                TextColumn::make('order_number')
                    ->label('Order Number')
                    ->searchable()
                    ->sortable()
                    ->url(fn(Model $st) => route('admin.order.show', $st->id)),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(['user.name' => 'name', 'user.id_no' => 'id_no'])
                    ->description(fn(Model $st) => $st->user->id_no),

                TextColumn::make('item_count')
                    ->label('Items')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('SAR')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M, Y h:i a')
                    ->sortable(),
//                ])
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                        'shipped' => 'Shipped',
                    ]),
            ]);
    }

    public function render()
    {
        return view('livewire.dash.order.index', ['header' => 'Orders'])
            ->layout('layouts.app', ['title' => 'Orders']);
    }
}
