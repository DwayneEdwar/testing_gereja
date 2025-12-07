<?php

namespace App\Filament\Resources\AnggotaKeluargas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnggotaKeluargasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kk.name_kk')
                    ->label('Nama Keluarga')
                    ->sortable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('jenis_kelamin')
                    ->badge(),
                TextColumn::make('tanggal_lahir')
                    ->date()
                    ->sortable(),
                TextColumn::make('status_dalam_keluarga')
                    ->searchable(),
                IconColumn::make('sudah_baptis')
                    ->boolean(),
                IconColumn::make('sudah_sidi')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
