<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Tables\Table;
use App\Models\AnggotaPelka;

class JemaatOverviewTable extends TableWidget
{
    protected string|int|array $columnSpan = 'full';

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return AnggotaPelka::query()->with(['kelompok', 'anggotaKeluarga', 'dokumen.uploader']);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns($this->getTableColumns())
            ->headerActions([
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(route('jemaat.report.pdf'))
                    ->openUrlInNewTab(),
            ]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('kelompok.nama')->label('Nama Kelompok'),
            TextColumn::make('kelompok.ketua.name')->label('Nama Kordinator Kelompok'),
            TextColumn::make('anggotaKeluarga.nama')->label('Nama Anggota'),
            TextColumn::make('pelka.nama')->label('Pelka'),
            TextColumn::make('dokumen_baptis')
                ->label('Dokumen Baptis')
                ->getStateUsing(function ($record) {
                    $d = $record->dokumen->first();
                    if ($d && $d->file_baptis) {
                        return "<a href='".asset('storage/'.$d->file_baptis)."' target='_blank' class='text-blue-600 hover:text-blue-800 hover:underline font-medium inline-block'>📄 Lihat Baptis</a>";
                    }
                    return '-';
                })
                ->html()
                ->searchable(false)
                ->sortable(false),
            TextColumn::make('dokumen_sidi')
                ->label('Dokumen Sidi')
                ->getStateUsing(function ($record) {
                    $d = $record->dokumen->first();
                    if ($d && $d->file_sidi) {
                        return "<a href='".asset('storage/'.$d->file_sidi)."' target='_blank' class='text-blue-600 hover:text-blue-800 hover:underline font-medium inline-block'>📄 Lihat Sidi</a>";
                    }
                    return '-';
                })
                ->html()
                ->searchable(false)
                ->sortable(false),
            TextColumn::make('diunggah_oleh')
                ->label('Diunggah Oleh')
                ->getStateUsing(function ($record) {
                    if ($record->dokumen->isEmpty()) {
                        return '-';
                    }
                    return collect($record->dokumen)
                        ->map(fn($d) => $d->uploader?->name ?? '-')
                        ->filter()
                        ->implode('<br>');
                })
                ->html()
                ->wrap(),
        ];
    }
}
