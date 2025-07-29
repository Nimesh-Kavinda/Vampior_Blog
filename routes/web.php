<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/editor/dashboard', function () {
    return view('editor.dashboard');
})->middleware(['auth', 'verified'])->name('editor.dashboard');

// Admin API routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/posts', [AdminController::class, 'getPosts'])->name('admin.posts.index');
    Route::post('/posts', [AdminController::class, 'storePost'])->name('admin.posts.store');
    Route::put('/posts/{id}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::post('/posts/{id}/like', [AdminController::class, 'toggleLike'])->name('admin.posts.like');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
