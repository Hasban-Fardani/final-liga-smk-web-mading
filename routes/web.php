<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\CreatorDashboardController;
use App\Http\Controllers\CreatorPostController;
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

// User routes
Route::middleware(['auth', 'can:user'])->group(function () {
   Route::post('/logout', LogoutController::class)->name('logout');    
});

// Creator routes
Route::middleware(['auth', 'can:creator'])->group(function (){
    Route::get('/creator', CreatorDashboardController::class);
    Route::get('/creator/posts', [CreatorPostController::class, 'index']);
});

// Admin routes
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', AdminDashboardController::class)->name('admin.dashboard');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts');
});