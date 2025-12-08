<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AnggotaPelka;
use App\Models\Kelompok;
use App\Models\Dokumen;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $jumlahAnggota = AnggotaPelka::count();
        $jumlahKK = Kelompok::count();

        $sudahSidi = Dokumen::where('jenis', 'sidi')
            ->distinct('anggota_keluarga_id')
            ->count('anggota_keluarga_id');
        $belumSidi = $jumlahAnggota - $sudahSidi;

        $sudahBaptis = Dokumen::where('jenis', 'baptis')
            ->distinct('anggota_keluarga_id')
            ->count('anggota_keluarga_id');
        $belumBaptis = $jumlahAnggota - $sudahBaptis;

        return [
            Stat::make('Jumlah jemaat', $jumlahAnggota)
                ->description('Total semua anggota jemaat')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([5, 10, 15, 20, 25, 30, $jumlahAnggota]),

            Stat::make('Jumlah Keluarga', $jumlahKK)
                ->description('Total keluarga')
                ->descriptionIcon('heroicon-m-home')
                ->color('primary')
                ->chart([2, 4, 6, 8, 10, 12, $jumlahKK]),

            Stat::make('Sudah Sidi', $sudahSidi)
                ->description('Anggota yang sudah Sidi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([1, 3, 5, 7, 9, 11, $sudahSidi]),

            Stat::make('Belum Sidi', $belumSidi)
                ->description('Anggota yang belum Sidi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger')
                ->chart([2, 4, 6, 8, 10, 12, $belumSidi]),

            Stat::make('Sudah Baptis', $sudahBaptis)
                ->description('Anggota yang sudah Baptis')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([1, 2, 4, 6, 8, 10, $sudahBaptis]),

            Stat::make('Belum Baptis', $belumBaptis)
                ->description('Anggota yang belum Baptis')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger')
                ->chart([2, 3, 5, 7, 9, 11, $belumBaptis]),
        ];
    }
}
