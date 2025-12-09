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
                    ->relationship('anggota', 'nama', function ($query) {
                        $user = auth()->user();
                        if ($user->hasRole('super_admin')) {
                            // Super admin dapat melihat semua anggota
                            return $query;
                        } else {
                            // Kordinator hanya dapat melihat anggota kelompoknya sendiri
                            $kelompokUser = \App\Models\Kelompok::where('ketua_id', $user->id)->first();
                            if ($kelompokUser) {
                                return $query->whereHas('kk', function ($q) use ($kelompokUser) {
                                    $q->where('kelompok_id', $kelompokUser->id);
                                });
                            } else {
                                // Jika bukan kordinator, tampilkan kosong
                                return $query->whereRaw('1 = 0');
                            }
                        }
                    })
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
