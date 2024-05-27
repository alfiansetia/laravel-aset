<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes([
    'register'  => false,
    'verify'    => false,
    'reset'     => false,
]);



Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('tracking', [TrackingController::class, 'index'])->name('tracking.index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('users', [Usercontroller::class, 'index'])->name('users.index');
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('jenis', [JenisController::class, 'index'])->name('jenis.index');
        Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
        Route::get('asets', [AsetController::class, 'index'])->name('asets.index');
    });
});
