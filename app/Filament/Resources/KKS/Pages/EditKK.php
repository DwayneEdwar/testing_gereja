<?php

namespace App\Filament\Resources\KKS\Pages;

use App\Filament\Resources\KKS\KKResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKK extends EditRecord
{
    protected static string $resource = KKResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
