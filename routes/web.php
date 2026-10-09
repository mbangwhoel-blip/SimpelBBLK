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

});
