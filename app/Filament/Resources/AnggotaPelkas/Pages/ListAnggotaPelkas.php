<?php

namespace App\Filament\Resources\AnggotaPelkas\Pages;

use App\Filament\Resources\AnggotaPelkas\AnggotaPelkaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnggotaPelkas extends ListRecords
{
    protected static string $resource = AnggotaPelkaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
