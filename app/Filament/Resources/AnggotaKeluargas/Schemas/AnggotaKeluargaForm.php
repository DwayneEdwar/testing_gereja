<?php

namespace App\Filament\Resources\AnggotaKeluargas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnggotaKeluargaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kk_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nama')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options(['L' => 'L', 'P' => 'P'])
                    ->required(),
                DatePicker::make('tanggal_lahir'),
                TextInput::make('status_dalam_keluarga'),
                Toggle::make('sudah_baptis')
                    ->required(),
                Toggle::make('sudah_sidi')
                    ->required(),
            ]);
    }
}
