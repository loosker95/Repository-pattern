<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('index.post');

    Route::get('/create', 'create')->name('create.post');
    Route::post('/', 'store')->name('store.post');

    Route::get('/show/{slug}', 'show')->name('show.post');

    Route::get('/post/{id}/edit', 'edit')->name('change.post');
    Route::put('/update/{id}', 'update')->name('update.post');

    Route::delete('/remove/{id}', 'delete')->name('remove.post');
});

Route::post('/comment/{id}', [CommentController::class, 'commentSomething'])->name('add.comment');
