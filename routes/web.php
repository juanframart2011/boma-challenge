<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('login');

#Modulos de auth
Route::prefix('auth')->name('auth.')->group(function(){

    Route::post('validate-login', [AuthController::class, 'validateLogin'])->name('validate-login');
});


Route::group(['prefix' => 'admin'], function(){

    Route::get( 'home', [ HomeController::class, 'home' ] )->name('home');
    Route::get( 'logout', [ AuthController::class, 'logout' ] )->name('logout');

    #Campañas
    Route::prefix('campaign')->name('campaign.')->group(function(){

        Route::get( 'list', [ CampaignsController::class, 'index' ] )->name('list');

        Route::get( 'create', [ CampaignsController::class, 'create' ] )->name('create');
        Route::post( 'save', [ CampaignsController::class, 'save' ] )->name('save');
        
        Route::get( 'edit/{id}', [ CampaignsController::class, 'edit' ] )->name('edit');
        Route::put( 'update/{id}', [ CampaignsController::class, 'update' ] )->name('update');

        Route::post( 'delete', [ CampaignsController::class, 'delete' ] )->name('delete');
    });

    #Usuarios
    Route::prefix('user')->name('user.')->group(function(){

        Route::get( 'profile', [ UserController::class, 'profile' ] )->name('profile');

        Route::get( 'list', [ UserController::class, 'index' ] )->name('list');

        Route::get( 'create', [ UserController::class, 'create' ] )->name('create');
        Route::post( 'save', [ UserController::class, 'save' ] )->name('save');
        
        Route::get( 'edit/{id}', [ UserController::class, 'edit' ] )->name('edit');
        Route::get( 'detail/{id}', [ UserController::class, 'detail' ] )->name('detail');
        Route::put( 'update/{id}', [ UserController::class, 'update' ] )->name('update');

        Route::post( 'delete', [ UserController::class, 'delete' ] )->name('delete');
    });
})->middleware(VerifyProfile::class);