<?php

namespace App\Http\Controllers;

use App\Models\ChurchInfo;
use App\Models\AnggotaPelka;
use App\Models\Kelompok;
use App\Models\Pelka;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class ChurchDashboardController extends Controller
{
    public function index()
    {
        $churchInfo = ChurchInfo::first();
        
        // Statistics
        $stats = [
            'total_jemaat' => AnggotaPelka::count(),
            'total_kelompok' => Kelompok::count(),
            'total_pelka' => Pelka::count(),
            'sudah_baptis' => Dokumen::whereNotNull('file_baptis')
                ->distinct('anggota_keluarga_id')
                ->count('anggota_keluarga_id'),
            'sudah_sidi' => Dokumen::whereNotNull('file_sidi')
                ->distinct('anggota_keluarga_id')
                ->count('anggota_keluarga_id'),
        ];
        
        // Recent activities
        $recentMembers = AnggotaPelka::with(['anggotaKeluarga', 'kelompok'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentDocs = Dokumen::with(['anggota', 'uploader'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('church-dashboard', compact('churchInfo', 'stats', 'recentMembers', 'recentDocs'));
    }
}