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
            TextColumn::make('kelompok.nama')->label('Nama KK'),
            TextColumn::make('anggotaKeluarga.nama')->label('Nama Anggota'),
            TextColumn::make('pelka.nama')->label('Pelka'),
            TextColumn::make('dokumen_sidi')
                ->label('Sudah Sidi')
                ->getStateUsing(fn($record) => $record->dokumen->where('jenis','sidi')->count() ? 'Ya' : 'Belum'),
            TextColumn::make('dokumen_baptis')
                ->label('Sudah Baptis')
                ->getStateUsing(fn($record) => $record->dokumen->where('jenis','baptis')->count() ? 'Ya' : 'Belum'),
            TextColumn::make('dokumen')
                ->label('Dokumen')
                ->getStateUsing(function ($record) {
                    if ($record->dokumen->isEmpty()) {
                        return 'Tidak ada dokumen';
                    }
                    return collect($record->dokumen)
                        ->map(fn($d) => "<a href='".asset('storage/'.$d->file)."' target='_blank' class='text-blue-600 hover:text-blue-800 hover:underline font-medium inline-block'>📄 Lihat Dokumen (".ucfirst($d->jenis).")</a>")
                        ->implode('<br>');
                })
                ->html()
                ->searchable(false)
                ->sortable(false)
                ->wrap(),
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
