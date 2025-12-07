<?php

namespace App\Filament\Resources\Kelompoks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\User;
use Filament\Forms\Components\Select;

class KelompokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Select::make('ketua_id')
                    ->label('Ketua')
                    ->relationship('ketua', 'name') // relasi Eloquent
                    ->options(function () {
                        // Ambil user dengan role kordinator
                        return User::role('kordinator')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->nullable(),
            ]);
    }
}
