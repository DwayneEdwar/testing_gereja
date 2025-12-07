<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('anggota_keluarga_id')
                    ->required()
                    ->numeric(),
                Select::make('jenis')
                    ->options(['baptis' => 'Baptis', 'sidi' => 'Sidi'])
                    ->required(),
                TextInput::make('file'),
                TextInput::make('diunggah_oleh')
                    ->numeric(),
            ]);
    }
}
