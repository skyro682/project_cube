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

// Route public
Auth::routes();
Route::get('/', [App\Http\Controllers\RessourcesController::class, 'listAll'])->name('home');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'searchRes'])->name('search');
Route::get('/advancedSearch', [App\Http\Controllers\AdvancedSearchController::class, 'searchRes'])->name('advancedSearch');
Route::get('/contact', [App\Http\Controllers\OtherController::class, 'contact'])->name('contact');
Route::get('/help', [App\Http\Controllers\OtherController::class, 'help'])->name('help');
Route::get('/ressource/{id}', [App\Http\Controllers\RessourcesController::class, 'viewRes'])->name('viewRes');


// Route Utilisateur Connecter
Route::middleware('auth')->group(function () {
    
    Route::get('/game', [App\Http\Controllers\GameController::class, 'game'])->name('game');
    Route::post('/checked', [App\Http\Controllers\GameController::class, 'checked'])->name('checked');

    // Route ressource
    Route::prefix('ressources')->name('ressources.')->group(function () {

        Route::get('/delete/{id}', [App\Http\Controllers\RessourcesController::class, 'deleteRessource'])->name('delete');
        Route::get('/add', [App\Http\Controllers\RessourcesController::class, 'addRes'])->name('add');
        Route::Post('/add', [App\Http\Controllers\RessourcesController::class, 'addResClick']);
        Route::get('/update/{id}', [App\Http\Controllers\RessourcesController::class, 'updateRes'])->name('update');
        Route::Post('/update/{id}', [App\Http\Controllers\RessourcesController::class, 'updateResClick']);
        // Comments ressource
        Route::post('/addComment/{id}', [App\Http\Controllers\RessourcesController::class, 'addComment'])->name('addComment');
        Route::get('/deleteComment/{id}/{id_com}', [App\Http\Controllers\RessourcesController::class, 'deleteComment'])->name('deleteComment');
        Route::get('/viewUpdateComment/{id}/{id_com}', [App\Http\Controllers\RessourcesController::class, 'viewUpdateComment'])->name('viewUpdateComment');
        Route::post('/updateComment/{id}/{id_com}', [App\Http\Controllers\RessourcesController::class, 'updateComment'])->name('updateComment');
    });

    //favorite.add_or_delete
    // Route favorite // favorite
    Route::prefix('favorite')->name('favorite.')->group(function () {
        Route::get('/viewFavorite', [App\Http\Controllers\RessourcesController::class, 'viewFavorite'])->name('viewFavorite');
        Route::get('/add_or_delete/{id}/{add}/{view}', [App\Http\Controllers\RessourcesController::class, 'add_or_delete'])->name('add_or_delete');
    });

    // Route profile
    Route::prefix('profile')->group(function () {

        Route::get('/', [App\Http\Controllers\UsersController::class, 'profile'])->name('profile');
        Route::get('/messagerie', [App\Http\Controllers\UsersController::class, 'messagerie'])->name('messagerie');
        Route::get('/messagerie/messages', [UsersController::class, 'fetchMessages']);
        Route::post('/messagerie/messages', [UsersController::class, 'sendMessage']);
        Route::post('/edit/{section}', [App\Http\Controllers\UsersController::class, 'editProfile'])->name('editProfile');
        Route::get('/delete', [App\Http\Controllers\UsersController::class, 'deleteProfile'])->name('deleteProfile');
    });

    // Route Super Admin
    Route::middleware('admin.super')->group(function () {

        // Route gestion users
        Route::prefix('users')->name('users.')->group(function () {

            Route::get('/', [App\Http\Controllers\UsersController::class, 'list'])->name('home');
            Route::post('/grade', [App\Http\Controllers\UsersController::class, 'editGrade'])->name('grade');
            Route::get('/delete/{id}', [App\Http\Controllers\UsersController::class, 'deleteUser'])->name('delete');
        });



    });

    // Route Super Admin
    Route::middleware('admin')->group(function () {

        Route::prefix('stat')->name('stat.')->group(function () {
            Route::get('/statGlobal', [App\Http\Controllers\StatController::class, 'statGlobal'])->name('statGlobal');
        });



    });
});
