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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post("reviews", [ReviewController::class, "store"])->name("reviews.store");

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/show/{id}', [App\Http\Controllers\ItemController::class, 'show']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update']);
    Route::get('/delete/{id}', [App\Http\Controllers\ItemController::class, 'delete']);
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'search']);
});

Route::group(['middleware' => ['auth', 'can:admin']], function() {
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);

    Route::get('/item/index', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create']);
    Route::post('/item/store', [App\Http\Controllers\ItemController::class, 'store']);
    Route::get('/item/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    Route::post('/item/update', [App\Http\Controllers\ItemController::class, 'update']);
    Route::get('/item/delete/{id}', [App\Http\Controllers\ItemController::class, 'delete']);
});
