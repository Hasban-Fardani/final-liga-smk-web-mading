<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReadPostController;
use App\Http\Controllers\SavedPostContoller;
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

Route::get('/', IndexController::class)->name('index');
Route::get('/about', AboutController::class)->name('about');
Route::post('/login', LoginController::class)->name('login');

Route::get('/posts/{post:slug}', ReadPostController::class)->name('posts.read');
Route::get('/posts/saved', [SavedPostContoller::class, 'index'])->name('posts.saved');

Route::middleware('auth')->group(function () {
   Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});