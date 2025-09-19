<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    // show data like format on table
    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     $data['price'] = number_format($data['price'], 2, '.', '');
    //     return $data;
    // }
}
