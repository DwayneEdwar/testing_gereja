<?php

namespace App\Filament\Resources\KKS;

use App\Filament\Resources\KKS\Pages\CreateKK;
use App\Filament\Resources\KKS\Pages\EditKK;
use App\Filament\Resources\KKS\Pages\ListKKS;
use App\Filament\Resources\KKS\Schemas\KKForm;
use App\Filament\Resources\KKS\Tables\KKSTable;
use App\Models\KK;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KKResource extends Resource
{
    protected static ?string $model = KK::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name_KK';

    public static function form(Schema $schema): Schema
    {
        return KKForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KKSTable::configure($table);
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
            'index' => ListKKS::route('/'),
            'create' => CreateKK::route('/create'),
            'edit' => EditKK::route('/{record}/edit'),
        ];
    }
}
