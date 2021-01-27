<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\RessourcesController::class, 'listAll'])->name('home');
Route::get('/addRessource', [App\Http\Controllers\RessourcesController::class, 'addRes'])->name('addRes');
Route::Post('/addRessource', [App\Http\Controllers\RessourcesController::class, 'addResClick'])->name('addResClick');
Route::Post('/updateResClick', [App\Http\Controllers\RessourcesController::class, 'updateResClick'])->name('updateResClick');

