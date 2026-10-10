<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataUjiResistensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// -----------------------------------------------------------------------
// AUTH ROUTES (guest only)
// -----------------------------------------------------------------------

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// -----------------------------------------------------------------------
// PROTECTED ROUTES (auth required)
// -----------------------------------------------------------------------

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [
        DataUjiResistensiController::class,
        'dashboard',
    ])->name('dashboard');

    Route::get('/input', [
        DataUjiResistensiController::class,
        'index',
    ])->name('input');

    Route::post('/input', [
        DataUjiResistensiController::class,
        'store',
    ])->name('input.store');

    Route::delete('/input/{id}', [
        DataUjiResistensiController::class,
        'destroy',
    ])->name('input.destroy');

    Route::get('/input/{id}/edit', [
        DataUjiResistensiController::class,
        'edit',
    ])->name('input.edit');

    Route::put('/input/{id}', [
        DataUjiResistensiController::class,
        'update',
    ])->name('input.update');

    Route::get('/kabupaten/{provinsi_id}', [
        DataUjiResistensiController::class,
        'getKabupaten',
    ])->name('kabupaten');

    Route::get('/laporan', function () {
        return view('laporan');
    })->name('laporan');

    // ── DATA MENU ────────────────────────────────────────
    Route::get('/import', [App\Http\Controllers\ImportExportController::class, 'indexImport'])->name('import.index');
    Route::post('/import', [App\Http\Controllers\ImportExportController::class, 'import'])->name('import.upload');
    Route::get('/export', [App\Http\Controllers\ImportExportController::class, 'indexExport'])->name('export.index');
    Route::get('/export/download', [App\Http\Controllers\ImportExportController::class, 'export'])->name('export.download');
    Route::get('/export/template', [App\Http\Controllers\ImportExportController::class, 'downloadTemplate'])->name('export.template');

    // ── MASTER DATA ──────────────────────────────────────
    Route::get('/master/wilayah', [App\Http\Controllers\WilayahController::class, 'index'])->name('wilayah.index');
    Route::post('/master/wilayah', [App\Http\Controllers\WilayahController::class, 'store'])->name('wilayah.store');
    Route::get('/master/wilayah/{id}/edit', [App\Http\Controllers\WilayahController::class, 'editKoordinat'])->name('wilayah.edit');
    Route::put('/master/wilayah/{id}', [App\Http\Controllers\WilayahController::class, 'updateKoordinat'])->name('wilayah.update');

    Route::get('/master/unit', [App\Http\Controllers\UnitController::class, 'index'])->name('unit.index');
    Route::get('/master/unit/create', [App\Http\Controllers\UnitController::class, 'create'])->name('unit.create');
    Route::post('/master/unit', [App\Http\Controllers\UnitController::class, 'store'])->name('unit.store');
    Route::get('/master/unit/{id}/edit', [App\Http\Controllers\UnitController::class, 'edit'])->name('unit.edit');
    Route::put('/master/unit/{id}', [App\Http\Controllers\UnitController::class, 'update'])->name('unit.update');
    Route::delete('/master/unit/{id}', [App\Http\Controllers\UnitController::class, 'destroy'])->name('unit.destroy');

});
