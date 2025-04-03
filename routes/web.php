<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

#Modulos de auth
Route::prefix('auth')->name('auth.')->group(function(){

    Route::post('validate-login', [AuthController::class, 'validateLogin'])->name('validate-login');
});