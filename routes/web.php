<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArsipController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('surat-masuk', SuratMasukController::class);
Route::resource('surat-keluar', SuratKeluarController::class);
Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
Route::get('/arsip/export-pdf', [ArsipController::class, 'exportPdf'])->name('arsip.export-pdf');
Route::get('/arsip/export-excel', [ArsipController::class, 'exportExcel'])->name('arsip.export-excel');
