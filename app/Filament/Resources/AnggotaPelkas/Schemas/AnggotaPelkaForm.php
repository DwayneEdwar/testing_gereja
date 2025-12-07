<?php

namespace App\Filament\Resources\AnggotaPelkas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnggotaPelkaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kelompok_id')
                    ->required()
                    ->numeric(),
                TextInput::make('pelka_id')
                    ->required()
                    ->numeric(),
                TextInput::make('anggota_keluarga_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
