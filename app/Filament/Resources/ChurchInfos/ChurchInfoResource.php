<?php

namespace App\Filament\Resources\ChurchInfos;

use App\Filament\Resources\ChurchInfos\Pages\CreateChurchInfo;
use App\Filament\Resources\ChurchInfos\Pages\EditChurchInfo;
use App\Filament\Resources\ChurchInfos\Pages\ListChurchInfos;
use App\Filament\Resources\ChurchInfos\Schemas\ChurchInfoForm;
use App\Filament\Resources\ChurchInfos\Tables\ChurchInfosTable;
use App\Models\ChurchInfo;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ChurchInfoResource extends Resource
{
    protected static ?string $model = ChurchInfo::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $recordTitleAttribute = 'nama_gereja';

    protected static ?string $navigationLabel = 'Informasi Gereja';

    protected static string | UnitEnum | null $navigationGroup = 'Setting';

    public static function form(Schema $schema): Schema
    {
        return ChurchInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChurchInfosTable::configure($table);
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
            'index' => ListChurchInfos::route('/'),
            'create' => CreateChurchInfo::route('/create'),
            'edit' => EditChurchInfo::route('/{record}/edit'),
        ];
    }
}
