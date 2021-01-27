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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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