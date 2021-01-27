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

//Route profile
Route::get('/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');
Route::post('/profile/edit/{section}', [App\Http\Controllers\UsersController::class, 'editProfile'])->name('editProfile');
Route::get('/profile/delete', [App\Http\Controllers\UsersController::class, 'deleteProfile'])->name('deleteProfile');

// Route admin
Route::middleware('admin.super')->group(function(){

    // Route gestion users
    Route::prefix('users')->name('users.')->group(function(){

        Route::get('/', [App\Http\Controllers\UsersController::class, 'list'])->name('home');
        Route::post('/grade', [App\Http\Controllers\UsersController::class, 'editGrade'])->name('grade');
        Route::get('/delete/{id}', [App\Http\Controllers\UsersController::class, 'deleteUser'])->name('delete');
    
    });
});