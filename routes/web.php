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
//add ressource
Route::get('/delete/{id}', [App\Http\Controllers\RessourcesController::class, 'deleteRessource'])->name('deleteRessource');
Route::get('/addRessource', [App\Http\Controllers\RessourcesController::class, 'addRes'])->name('addRes');
Route::Post('/addResClick', [App\Http\Controllers\RessourcesController::class, 'addResClick'])->name('addResClick');
Route::get('/updateRes/{id}', [App\Http\Controllers\RessourcesController::class, 'updateRes'])->name('updateRes');
Route::Post('/updateResClick/{id}', [App\Http\Controllers\RessourcesController::class, 'updateResClick'])->name('updateResClick');
//view ressource
Route::get('/ressource/{id}', [App\Http\Controllers\RessourcesController::class, 'viewRes'])->name('viewRes');


