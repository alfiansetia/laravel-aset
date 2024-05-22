<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\JenisController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('users', UserController::class)->names('api.users');
    Route::apiResource('categories', CategoryController::class)->names('api.categories');
    Route::apiResource('jenis', JenisController::class)->parameters(['jenis' => 'jenis'])->names('api.jenis');
    Route::apiResource('locations', LocationController::class)->names('api.locations');
});
