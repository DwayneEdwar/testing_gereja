<?php

namespace App\Filament\Resources\ChurchInfos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ChurchInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_gereja')
                    ->required(),
                TextInput::make('alamat')
                    ->required(),
                TextInput::make('gembala_jemaat'),
                TextInput::make('kontak_gereja'),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }
}
