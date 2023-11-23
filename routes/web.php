<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReviewController;
use App\Models\Review;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();




Route::group(['middleware' => ['auth', 'can:admin']], function () {
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);


    Route::get('/items/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/items/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/items/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name("item.edit");
    Route::post('/items/update', [App\Http\Controllers\ItemController::class, 'update']);
    Route::get('/items/delete/{id}', [App\Http\Controllers\ItemController::class, 'delete'])->name("item.delete");
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post("reviews", [ReviewController::class, "store"])->name("reviews.store");
    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/items/show/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name("item.show");
    Route::get('/items/search', [App\Http\Controllers\ItemController::class, 'search']);

    Route::post('/items/{id}/bookmark', [App\Http\Controllers\BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/items/{id}/unbookmark', [App\Http\Controllers\BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get("/items/bookmark", [App\Http\Controllers\BookmarkController::class, 'index'])->name('bookmark.index');
});
