<?php

namespace App\Filament\Resources\AnggotaPelkas;

use App\Filament\Resources\AnggotaPelkas\Pages\CreateAnggotaPelka;
use App\Filament\Resources\AnggotaPelkas\Pages\EditAnggotaPelka;
use App\Filament\Resources\AnggotaPelkas\Pages\ListAnggotaPelkas;
use App\Filament\Resources\AnggotaPelkas\Schemas\AnggotaPelkaForm;
use App\Filament\Resources\AnggotaPelkas\Tables\AnggotaPelkasTable;
use App\Models\AnggotaPelka;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AnggotaPelkaResource extends Resource
{
    protected static ?string $model = AnggotaPelka::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'pelka_id';

    public static function form(Schema $schema): Schema
    {
        return AnggotaPelkaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnggotaPelkasTable::configure($table);
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
            'index' => ListAnggotaPelkas::route('/'),
            'create' => CreateAnggotaPelka::route('/create'),
            'edit' => EditAnggotaPelka::route('/{record}/edit'),
        ];
    }
}
