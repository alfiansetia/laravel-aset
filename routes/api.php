<?php

use App\Http\Controllers\Api\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('users', Usercontroller::class)->names('api.users');
});
