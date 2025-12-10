<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JemaatReportController;
use App\Http\Controllers\ChurchDashboardController;

Route::get('/', [ChurchDashboardController::class, 'index'])->name('home');

Route::get('/admin/jemaat/report/pdf', [JemaatReportController::class, 'downloadPdf'])
    ->middleware(['auth'])
    ->name('jemaat.report.pdf');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
