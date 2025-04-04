<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CampaignsController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/


Route::post('login', [AuthController::class, 'login']);

Route::get('/test', function () {
    return response()->json(['message' => 'Ruta API activa']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);


    Route::get('/dashboard', [CampaignsController::class, 'dashboard']);
    Route::get('/landig/{campaingId}', [CampaignsController::class, 'landig']);
});