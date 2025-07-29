<?php

use Illuminate\Support\Facades\Auth;
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

    $user = Auth::user();

    if ($user && $user->role === 'admin') {
        return redirect()->intended('/admin/dashboard');
    } elseif ($user && $user->role === 'editor') {
        return redirect()->intended('/editor/dashboard');
    } elseif ($user && $user->role === 'reader') {
        return redirect()->intended('/dashboard');
    } else {
        return view('welcome');
    }
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
    // Post management routes
    Route::get('/posts', [AdminController::class, 'getPosts'])->name('admin.posts.index');
    Route::post('/posts', [AdminController::class, 'storePost'])->name('admin.posts.store');
    Route::put('/posts/{id}', [AdminController::class, 'updatePost'])->name('admin.posts.update');
    Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::post('/posts/{id}/like', [AdminController::class, 'toggleLike'])->name('admin.posts.like');

    // User management routes
    Route::get('/users', [AdminController::class, 'getUsers'])->name('admin.users.index');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
