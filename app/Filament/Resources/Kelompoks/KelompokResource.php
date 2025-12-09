<?php

namespace App\Filament\Resources\Kelompoks;

use App\Filament\Resources\Kelompoks\Pages\CreateKelompok;
use App\Filament\Resources\Kelompoks\Pages\EditKelompok;
use App\Filament\Resources\Kelompoks\Pages\ListKelompoks;
use App\Filament\Resources\Kelompoks\Schemas\KelompokForm;
use App\Filament\Resources\Kelompoks\Tables\KelompoksTable;
use App\Models\Kelompok;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KelompokResource extends Resource
{
    protected static ?string $model = Kelompok::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Kelompok';

    protected static string | UnitEnum | null $navigationGroup = 'Data Kelompok';

    public static function form(Schema $schema): Schema
    {
        return KelompokForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelompoksTable::configure($table);
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
            'index' => ListKelompoks::route('/'),
            'create' => CreateKelompok::route('/create'),
            'edit' => EditKelompok::route('/{record}/edit'),
        ];
    }
}
