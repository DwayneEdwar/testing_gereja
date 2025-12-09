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
        $user = auth()->user();

        // Jumlah Kelompok selalu total untuk semua user
        $jumlahKK = Kelompok::count();

        // Jika user adalah super admin, tampilkan semua data
        if ($user->hasRole('super_admin')) {
            $jumlahAnggota = AnggotaPelka::count();

            $sudahSidi = Dokumen::whereNotNull('file_sidi')
                ->distinct('anggota_keluarga_id')
                ->count('anggota_keluarga_id');
            $belumSidi = $jumlahAnggota - $sudahSidi;

            $sudahBaptis = Dokumen::whereNotNull('file_baptis')
                ->distinct('anggota_keluarga_id')
                ->count('anggota_keluarga_id');
            $belumBaptis = $jumlahAnggota - $sudahBaptis;
        } else {
            // Jika user adalah kordinator kelompok, tampilkan hanya data kelompoknya
            $kelompokUser = Kelompok::where('ketua_id', $user->id)->first();
            if ($kelompokUser) {
                $jumlahAnggota = AnggotaPelka::where('kelompok_id', $kelompokUser->id)->count();

                $sudahSidi = Dokumen::whereNotNull('file_sidi')
                    ->whereHas('anggota.kk', function ($q) use ($kelompokUser) {
                        $q->where('kelompok_id', $kelompokUser->id);
                    })
                    ->distinct('anggota_keluarga_id')
                    ->count('anggota_keluarga_id');
                $belumSidi = $jumlahAnggota - $sudahSidi;

                $sudahBaptis = Dokumen::whereNotNull('file_baptis')
                    ->whereHas('anggota.kk', function ($q) use ($kelompokUser) {
                        $q->where('kelompok_id', $kelompokUser->id);
                    })
                    ->distinct('anggota_keluarga_id')
                    ->count('anggota_keluarga_id');
                $belumBaptis = $jumlahAnggota - $sudahBaptis;
            } else {
                // Jika bukan super admin atau kordinator, tampilkan data kosong
                $jumlahAnggota = 0;
                $sudahSidi = 0;
                $belumSidi = 0;
                $sudahBaptis = 0;
                $belumBaptis = 0;
            }
        }

        return [
            Stat::make('Jumlah jemaat', $jumlahAnggota)
                ->description('Total semua anggota jemaat')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([5, 10, 15, 20, 25, 30, $jumlahAnggota]),

            Stat::make('Jumlah Kelompok', $jumlahKK)
                ->description('Total kelompok ibadah')
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
