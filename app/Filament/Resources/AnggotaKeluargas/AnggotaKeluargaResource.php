<?php

namespace App\Filament\Resources\AnggotaKeluargas;

use App\Filament\Resources\AnggotaKeluargas\Pages\CreateAnggotaKeluarga;
use App\Filament\Resources\AnggotaKeluargas\Pages\EditAnggotaKeluarga;
use App\Filament\Resources\AnggotaKeluargas\Pages\ListAnggotaKeluargas;
use App\Filament\Resources\AnggotaKeluargas\Schemas\AnggotaKeluargaForm;
use App\Filament\Resources\AnggotaKeluargas\Tables\AnggotaKeluargasTable;
use App\Models\AnggotaKeluarga;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnggotaKeluargaResource extends Resource
{
    protected static ?string $model = AnggotaKeluarga::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';

    protected static ?string $recordTitleAttribute = 'nama';

    protected static ?string $navigationLabel = 'Anggota Keluarga';

    protected static string | UnitEnum | null $navigationGroup = 'Data Jemaat';


    public static function form(Schema $schema): Schema
    {
        return AnggotaKeluargaForm::configure($schema);
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
                // Filter berdasarkan kelompok melalui relasi KK -> Kelompok
                $query->whereHas('kk', function ($q) use ($kelompokUser) {
                    $q->where('kelompok_id', $kelompokUser->id);
                });
            } else {
                // Jika bukan super admin atau kordinator, tampilkan data kosong
                $query->whereRaw('1 = 0');
            }
        }

        return AnggotaKeluargasTable::configure($table->query($query));
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
            'index' => ListAnggotaKeluargas::route('/'),
            'create' => CreateAnggotaKeluarga::route('/create'),
            'edit' => EditAnggotaKeluarga::route('/{record}/edit'),
        ];
    }
}
