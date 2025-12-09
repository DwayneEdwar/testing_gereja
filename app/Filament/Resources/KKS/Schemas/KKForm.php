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
                TextInput::make('alamat'),
            ]);
    }
}
