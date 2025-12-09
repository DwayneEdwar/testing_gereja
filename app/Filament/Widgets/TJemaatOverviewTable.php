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
        $query = AnggotaPelka::query()->with(['kelompok', 'anggotaKeluarga', 'dokumen.uploader']);

        $user = auth()->user();

        // Jika user adalah super admin, tampilkan semua data
        if ($user->hasRole('super_admin')) {
            return $query;
        }

        // Jika user adalah kordinator kelompok, tampilkan hanya data kelompoknya
        $kelompokUser = \App\Models\Kelompok::where('ketua_id', $user->id)->first();
        if ($kelompokUser) {
            return $query->where('kelompok_id', $kelompokUser->id);
        }

        // Jika bukan super admin atau kordinator, tampilkan data kosong atau sesuai kebutuhan
        return $query->whereRaw('1 = 0'); // Tidak tampilkan data apapun
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
            TextColumn::make('anggotaKeluarga.nama')->label('Nama Jemaat'),
            TextColumn::make('pelka.nama')->label('Pelka'),
            TextColumn::make('status_baptis')
                ->label('Status Baptis')
                ->getStateUsing(function ($record) {
                    $d = $record->dokumen->first();
                    return $d && $d->file_baptis ? 'Sudah' : 'Belum';
                })
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Sudah' => 'success',
                    'Belum' => 'danger',
                }),
            TextColumn::make('status_sidi')
                ->label('Status Sidi')
                ->getStateUsing(function ($record) {
                    $d = $record->dokumen->first();
                    return $d && $d->file_sidi ? 'Sudah' : 'Belum';
                })
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Sudah' => 'success',
                    'Belum' => 'danger',
                }),
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
