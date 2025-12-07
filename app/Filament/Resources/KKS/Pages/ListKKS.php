<?php

namespace App\Filament\Resources\KKS\Pages;

use App\Filament\Resources\KKS\KKResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKKS extends ListRecords
{
    protected static string $resource = KKResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
