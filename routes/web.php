<?php

use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::get('users', [Usercontroller::class, 'index'])->name('users.index');
});
