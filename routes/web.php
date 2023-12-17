<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPublishPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\CreatorDashboardController;
use App\Http\Controllers\CreatorPublishPostController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostSlugController;
use App\Http\Controllers\ReadPostController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\SearchPostController;
use App\Http\Controllers\UploadImageController;
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
Route::get('/search', SearchPostController::class)->name('search');
Route::post('/login', LoginController::class)->name('login');

// Public routes
Route::get('/read/{post:slug}', ReadPostController::class)->name('posts.read');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', LogoutController::class)->name('logout');
    Route::get('/saved', [SavedPostController::class, 'index'])->name('posts.saved');
    Route::post('/saved/{post}', [SavedPostController::class, 'store'])->name('posts.saved.store');
    Route::delete('/saved/{post}', [SavedPostController::class, 'destroy'])->name('posts.saved.destroy');

    Route::post('/upload', UploadImageController::class)->name('upload.image');

    // Creator routes
    Route::middleware('can:creator')->group(function () {
        Route::get('/creator', CreatorDashboardController::class)->name('creator.dashboard');
        Route::post('/creator/request/{post}', CreatorPublishPostController::class)->name('creator.request.admin');
    });

    // Post routes
    Route::middleware('can:create-post')->group(function () {
        Route::resource('/posts', PostController::class);
        Route::get('/create-slug', PostSlugController::class)->name('slug');
    });

    // Admin routes
    Route::middleware('can:admin')->group(function () {
        Route::post('/admin/publish/{post}', AdminPublishPostController::class)->name('admin.publish');

        Route::get('/admin', AdminDashboardController::class)->name('admin.dashboard');
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');
    });
});