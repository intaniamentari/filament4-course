<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable() // asc and desc
                    // ->searchable(isIndividual: true, isGlobal: false), // search only on column not global
                    ->searchable(), // search by name, default is global
                TextColumn::make('price')
                    ->money('IDR') // money format
                    // ->formatStateUsing(fn (int $state) => 'Rp ' . number_format($state, 2)) // $state is data from database
                    ->sortable(),
                TextColumn::make('status'),
                TextColumn::make('category.name'), // show the relationship name from category table
                TextColumn::make('tags.name'), // show the relationship name from tags table even if this is many to many relationship
            ])
            ->defaultSort('created_at', 'desc') // default sort by created_at
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Filter::make('created_from')
                    ->label('Created from')
                    ->schema([
                        DatePicker::make('created_from'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['created_from'] != null, function (Builder $query) use ($data) {
                            return $query->where('created_at', '>=', $data['created_from']);
                        });
                    }),
                Filter::make('created_to')
                    ->label('Created to')
                    ->schema([
                        DatePicker::make('created_to'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['created_to'] != null, function (Builder $query) use ($data) {
                            return $query->where('created_at', '<=', $data['created_to']);
                        });
                    })
            ], layout: FiltersLayout::AboveContent)
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(), // show button delete to table
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
