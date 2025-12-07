<?php

namespace App\Filament\Resources\KKS\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class KKForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_kk')
                    ->required(),
                TextInput::make('name_kk')
                    ->required(),
                Select::make('kelompok_id')
                    ->relationship('kelompok', 'nama'),
                TextInput::make('alamat'),
            ]);
    }
}
