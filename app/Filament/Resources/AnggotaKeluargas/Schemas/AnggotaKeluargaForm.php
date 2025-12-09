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
                Select::make('kk_id')
                    ->relationship('kk', 'name_kk', function ($query) {
                        $user = auth()->user();
                        if ($user->hasRole('super_admin')) {
                            // Super admin dapat melihat semua KK
                            return $query;
                        } else {
                            // Kordinator hanya dapat melihat KK kelompoknya sendiri
                            $kelompokUser = \App\Models\Kelompok::where('ketua_id', $user->id)->first();
                            if ($kelompokUser) {
                                return $query->where('kelompok_id', $kelompokUser->id);
                            } else {
                                // Jika bukan kordinator, tampilkan kosong
                                return $query->whereRaw('1 = 0');
                            }
                        }
                    })
                    ->label('Nama Keluarga'),
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
