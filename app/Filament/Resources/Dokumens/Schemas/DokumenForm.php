<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_keluarga_id')
                    ->required()
                    ->relationship('anggota', 'nama'),
                Select::make('jenis')
                    ->options(['baptis' => 'Baptis', 'sidi' => 'Sidi'])
                    ->required(),
                FileUpload::make('file')
                    ->required()
                    ->disk('public')
                    ->directory('dokumen'),
                Hidden::make('diunggah_oleh')
                ->default(fn () => auth()->id()),
            ]);
    }
}
