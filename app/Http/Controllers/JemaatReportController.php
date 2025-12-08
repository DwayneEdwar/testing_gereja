<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPelka;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JemaatReportController extends Controller
{
    public function downloadPdf()
    {
        $data = AnggotaPelka::with(['kelompok', 'anggotaKeluarga', 'dokumen.uploader'])->get();
        
        $pdf = Pdf::loadView('reports.jemaat-report', compact('data'));
        
        return $pdf->download('laporan-jemaat-' . date('Y-m-d') . '.pdf');
    }
}