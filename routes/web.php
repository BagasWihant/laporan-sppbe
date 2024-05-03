<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\MasterDataController;
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

    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(BarangController::class)->group(function(){
        Route::get('/barang','index')->name('barang');
        Route::post('/barang','uploadDataBarang')->name('uploadBarang');
    });
    
    Route::controller(MasterDataController::class)->group(function(){
        Route::get('/perusahaan','dataPerusahaan')->name('perusahaan');
    });


});

require __DIR__.'/auth.php';
