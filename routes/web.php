<?php

use App\Http\Controllers\PostsController;
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
    return redirect('https://dyk.digital');
});

Route::get('/api/posts', [PostsController::class, 'index']);
Route::post('/api/posts', [PostsController::class, 'create'])->middleware('auth:sanctum');
Route::get('/api/posts/{id}', [PostsController::class, 'show']);

Route::get('/api/userposts', [PostsController::class, 'userPosts'])->middleware('auth:sanctum');
Route::post('/api/posts/comment', [PostsController::class, 'comment'])->middleware('auth:sanctum');
Route::post('/api/posts/like', [PostsController::class, 'like'])->middleware('auth:sanctum');
