<?php

namespace App\Filament\Resources\AnggotaPelkas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class AnggotaPelkaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kelompok_id')
                    ->relationship('kelompok', 'nama'),
                Select::make('pelka_id')
                    ->required()
                    ->relationship('pelka', 'nama'),
                Select::make('anggota_keluarga_id')
                    ->required()
                    ->relationship('anggotaKeluarga', 'nama'),
            ]);
    }
}
