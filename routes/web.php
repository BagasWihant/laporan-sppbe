<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\LaporanRabController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index')->name('barang');
        Route::get('/showAllBarang', 'showAll')->name('barangShow');
        Route::post('/cariBarang', 'search')->name('barangSearch');
        Route::post('/barang', 'uploadDataBarang')->name('uploadBarang');
        Route::put('/barang', 'update')->name('updateBarang');
        Route::delete('/bulkDeleteBarang', 'bulkDelete')->name('bulkDeleteBarang');
    });


    Route::controller(PerusahaanController::class)->group(function () {
        Route::get('/perusahaan', 'index')->name('perusahaan');
        Route::get('/showAllPT', 'showAll')->name('PTShow');
        Route::post('/cariPT', 'search')->name('PTSearch');
        Route::put('/perusahaan', 'update')->name('updatePT');
        Route::delete('/bulkDeletePT', 'bulkDelete')->name('bulkDeletePT');
        Route::post('/perusahaan', 'store')->name('addPT');
    });

    Route::prefix('laporan')->group(function () {
        Route::resource('rab', LaporanRabController::class);
    });
});

require __DIR__ . '/auth.php';
