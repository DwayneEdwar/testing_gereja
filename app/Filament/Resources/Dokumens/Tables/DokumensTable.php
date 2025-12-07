<?php

namespace App\Filament\Resources\Dokumens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DokumensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('anggota.nama')
                    ->label('Nama Jemaat')
                    ->sortable(),
                TextColumn::make('jenis')
                    ->badge(),
                 TextColumn::make('file')
                    ->label('File')
                    ->url(fn ($record) => $record->file ? asset('storage/' . $record->file) : null)
                    ->formatStateUsing(fn ($state) => 'Lihat Document')
                    ->openUrlInNewTab()
                    ->searchable(),
                TextColumn::make('uploader.name')
                    ->label('Diunggah Oleh')
                    ->sortable()
                    ->toggleable(),
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
