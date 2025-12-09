<?php

namespace App\Filament\Resources\Dokumens;

use App\Filament\Resources\Dokumens\Pages\CreateDokumen;
use App\Filament\Resources\Dokumens\Pages\EditDokumen;
use App\Filament\Resources\Dokumens\Pages\ListDokumens;
use App\Filament\Resources\Dokumens\Schemas\DokumenForm;
use App\Filament\Resources\Dokumens\Tables\DokumensTable;
use App\Models\Dokumen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DokumenResource extends Resource
{
    protected static ?string $model = Dokumen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'anggota.nama';

    public static function form(Schema $schema): Schema
    {
        return DokumenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        $query = static::getModel()::query();

        $user = auth()->user();

        // Jika user adalah super admin, tampilkan semua data
        if ($user->hasRole('super_admin')) {
            // Tampilkan semua data
        } else {
            // Jika user adalah kordinator kelompok, tampilkan hanya data kelompoknya
            $kelompokUser = \App\Models\Kelompok::where('ketua_id', $user->id)->first();
            if ($kelompokUser) {
                // Filter berdasarkan kelompok melalui relasi anggota -> KK -> Kelompok
                $query->whereHas('anggota.kk', function ($q) use ($kelompokUser) {
                    $q->where('kelompok_id', $kelompokUser->id);
                });
            } else {
                // Jika bukan super admin atau kordinator, tampilkan data kosong
                $query->whereRaw('1 = 0');
            }
        }

        return DokumensTable::configure($table->query($query));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDokumens::route('/'),
            'create' => CreateDokumen::route('/create'),
            'edit' => EditDokumen::route('/{record}/edit'),
        ];
    }
}
