<?php

namespace App\Filament\Resources\AnggotaPelkas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class AnggotaPelkaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kelompok_id')
                    ->relationship('kelompok', 'nama', function ($query) {
                        $user = auth()->user();
                        if ($user->hasRole('super_admin')) {
                            // Super admin dapat melihat semua kelompok
                            return $query;
                        } else {
                            // Kordinator hanya dapat melihat kelompoknya sendiri
                            $kelompokUser = \App\Models\Kelompok::where('ketua_id', $user->id)->first();
                            if ($kelompokUser) {
                                return $query->where('id', $kelompokUser->id);
                            } else {
                                // Jika bukan kordinator, tampilkan kosong
                                return $query->whereRaw('1 = 0');
                            }
                        }
                    }),
                Select::make('pelka_id')
                    ->required()
                    ->relationship('pelka', 'nama'),
                Select::make('anggota_keluarga_id')
                    ->required()
                    ->relationship('anggotaKeluarga', 'nama', function ($query) {
                        $user = auth()->user();
                        if ($user->hasRole('super_admin')) {
                            // Super admin dapat melihat semua anggota keluarga
                            return $query;
                        } else {
                            // Kordinator hanya dapat melihat anggota keluarga kelompoknya sendiri
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
                    }),
            ]);
    }
}
