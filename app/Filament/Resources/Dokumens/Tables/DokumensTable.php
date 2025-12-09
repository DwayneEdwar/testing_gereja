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
                TextColumn::make('file_baptis')
                    ->label('File Baptis')
                    ->url(fn ($record) => $record->file_baptis ? asset('storage/' . $record->file_baptis) : null)
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat Baptis' : '-')
                    ->openUrlInNewTab(),
                TextColumn::make('file_sidi')
                    ->label('File Sidi')
                    ->url(fn ($record) => $record->file_sidi ? asset('storage/' . $record->file_sidi) : null)
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat Sidi' : '-')
                    ->openUrlInNewTab(),
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
