<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('anggota_keluarga_id')
                    ->label('Anggota Keluarga')
                    ->required()
                    ->relationship('anggota', 'nama')
                    ->searchable()
                    ->preload(),
                
                Grid::make(2)
                    ->schema([
                        Section::make('Dokumen Baptis')
                            ->description('Upload dokumen baptis')
                            ->schema([
                                FileUpload::make('file_baptis')
                                    ->label('File Baptis')
                                    ->disk('public')
                                    ->directory('dokumen/baptis')
                                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                                    ->maxSize(5120)
                                    ->downloadable()
                                    ->openable()
                                    ->helperText('Format: PDF atau gambar, Maksimal 5MB'),
                            ])
                            ->collapsible(),
                        
                        Section::make('Dokumen Sidi')
                            ->description('Upload dokumen sidi')
                            ->schema([
                                FileUpload::make('file_sidi')
                                    ->label('File Sidi')
                                    ->disk('public')
                                    ->directory('dokumen/sidi')
                                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                                    ->maxSize(5120)
                                    ->downloadable()
                                    ->openable()
                                    ->helperText('Format: PDF atau gambar, Maksimal 5MB'),
                            ])
                            ->collapsible(),
                    ]),
                
                Hidden::make('diunggah_oleh')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
