<?php

namespace App\Filament\Resources\Pelkas\Pages;

use App\Filament\Resources\Pelkas\PelkaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelkas extends ListRecords
{
    protected static string $resource = PelkaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
