<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);
Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create'])->middleware('auth');
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store'])->middleware('auth');
Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit'])->middleware('auth');
Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update'])->middleware('auth');
Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy'])->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
