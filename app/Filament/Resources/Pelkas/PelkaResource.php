<?php

namespace App\Filament\Resources\Pelkas;

use App\Filament\Resources\Pelkas\Pages\CreatePelka;
use App\Filament\Resources\Pelkas\Pages\EditPelka;
use App\Filament\Resources\Pelkas\Pages\ListPelkas;
use App\Filament\Resources\Pelkas\Schemas\PelkaForm;
use App\Filament\Resources\Pelkas\Tables\PelkasTable;
use App\Models\Pelka;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PelkaResource extends Resource
{
    protected static ?string $model = Pelka::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return PelkaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelkasTable::configure($table);
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
            'index' => ListPelkas::route('/'),
            'create' => CreatePelka::route('/create'),
            'edit' => EditPelka::route('/{record}/edit'),
        ];
    }
}
