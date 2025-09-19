<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    // redirect to index datatable after finish create
    // one by one technique, you must add this in each page
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }

    // change the value format before save
    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     $data['price'] = $data['price'] * 100;
    //     return $data;
    // }
}
