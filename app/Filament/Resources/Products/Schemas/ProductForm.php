<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Enums\ProductStatusEnum;
use App\Filament\Tables\CategoriesTable;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                TextInput::make('price')
                    ->label('Price')
                    ->prefix('IDR') // add label in input
                    ->required()
                    ->numeric(),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(5)
                    ->maxLength(255),
                Select::make('status')
                    ->label('Status')
                    ->options(
                        collect(ProductStatusEnum::cases())
                            ->mapWithKeys(fn ($case) => [$case->value => $case->value]) // key & label = value enum
                    )
                    ->required(),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'), // get data select by category
                // show the sidebar modal for select data, this option select if so many data issue
                // ModalTableSelect::make('category_id')
                //     ->label('Category')
                //     ->relationship('category', 'name') // get data select by category
                //     ->tableConfiguration(CategoriesTable::class)

                Select::make('tags')
                    ->label('Tags')
                    ->relationship('tags', 'name')
                    ->multiple()

            ])->columns(1); // make input is one column (default is 2)
    }
}
