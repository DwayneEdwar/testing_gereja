<?php

namespace App\Filament\Resources\Pelkas\Pages;

use App\Filament\Resources\Pelkas\PelkaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPelka extends EditRecord
{
    protected static string $resource = PelkaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
