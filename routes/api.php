<?php

use App\Http\Controllers\Api\AsetController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\JenisController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TrackingController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login'])->name('api.login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::get('profile', [AuthController::class, 'profile'])->name('api.profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::put('/profile', [ProfileController::class, 'password'])->name('api.password.update');

    Route::get('tracking/{aset:code}', [TrackingController::class, 'show'])->name('api.tracking.index');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::apiResource('users', UserController::class)->names('api.users');
        Route::apiResource('categories', CategoryController::class)->names('api.categories');
        Route::apiResource('jenis', JenisController::class)->parameters(['jenis' => 'jenis'])->names('api.jenis');
        Route::apiResource('locations', LocationController::class)->names('api.locations');
        Route::apiResource('asets', AsetController::class)->names('api.asets');
    });
});
