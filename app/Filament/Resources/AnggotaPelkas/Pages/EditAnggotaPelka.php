<?php

namespace App\Filament\Resources\AnggotaPelkas\Pages;

use App\Filament\Resources\AnggotaPelkas\AnggotaPelkaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAnggotaPelka extends EditRecord
{
    protected static string $resource = AnggotaPelkaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
