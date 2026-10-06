<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataUjiResistensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     return view('sidebar');
// });

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [
    DataUjiResistensiController::class,
    'dashboard'
])->name('dashboard');

Route::get('/input', [
    DataUjiResistensiController::class,
    'index'
])->name('input');

Route::post('input', [
    DataUjiResistensiController::class,
    'store'
])-> name('input.store');

Route::delete('/input/{id}', [
    DataUjiResistensiController::class,
    'destroy'
])->name('input.destroy');

// Route::post('/input/request-delete', [
//     DataUjiResistensiController::class,
//     'requestDelete'
// ])->name('input.requestDelete');

Route::get('/kabupaten/{provinsi_id}', [
    DataUjiResistensiController::class,
    'getKabupaten'
])->name('kabupaten');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

