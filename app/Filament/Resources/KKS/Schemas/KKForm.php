<?php

namespace App\Filament\Resources\KKS\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                TextInput::make('kelompok_id')
                    ->required()
                    ->numeric(),
                TextInput::make('alamat'),
            ]);
    }
}
