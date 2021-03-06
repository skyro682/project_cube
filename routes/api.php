<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::get('ressource', [\App\Http\Controllers\API\RessourcesController::class, 'index']);
Route::get('ressource/{id}', [\App\Http\Controllers\API\RessourcesController::class, 'show']);

Route::middleware('auth:api')->group(function(){

    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::apiResource('ressources', \App\Http\Controllers\API\RessourcesController::class);

});