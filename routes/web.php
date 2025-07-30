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

    if ($user) {
        // Redirect authenticated users to their appropriate dashboard
        switch ($user->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'editor':
                return redirect('/editor/dashboard');
            case 'reader':
                return redirect('/dashboard');
            default:
                return view('welcome');
        }
    }

    return view('welcome');
})->middleware('prevent.back');

// Single post routes for guests and readers
Route::get('/post/{id}', [AdminController::class, 'showPost'])->name('post.show');
Route::get('/singlepost/{id}', [AdminController::class, 'showPost'])->name('singlepost.show');

// API route for getting published posts (accessible to guests)
Route::get('/api/posts', [AdminController::class, 'getPublishedPosts'])->name('api.posts');

// Like functionality for authenticated users (web routes to maintain session)
Route::middleware('auth')->group(function () {
    Route::post('/api/posts/{id}/like', [AdminController::class, 'toggleLike'])->name('api.posts.like');

    // Debug route to test authentication
    Route::get('/api/auth-test', function () {
        $user = auth()->user();
        return response()->json([
            'authenticated' => auth()->check(),
            'user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ] : null
        ]);
    })->name('api.auth.test');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:reader', 'prevent.back'])->name('dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'role:admin', 'prevent.back'])
    ->name('admin.dashboard');

Route::get('/editor/dashboard', [App\Http\Controllers\EditorController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'role:editor', 'prevent.back'])
    ->name('editor.dashboard');

// Editor API routes
Route::middleware(['auth', 'verified', 'role:editor'])->prefix('editor')->group(function () {
    // Post management routes for editors
    Route::get('/posts', [App\Http\Controllers\EditorController::class, 'getPosts'])->name('editor.posts.index');
    Route::post('/posts', [App\Http\Controllers\EditorController::class, 'storePost'])->name('editor.posts.store');
    Route::put('/posts/{id}', [App\Http\Controllers\EditorController::class, 'updatePost'])->name('editor.posts.update');
    Route::delete('/posts/{id}', [App\Http\Controllers\EditorController::class, 'deletePost'])->name('editor.posts.delete');
    Route::post('/posts/{id}/like', [App\Http\Controllers\EditorController::class, 'toggleLike'])->name('editor.posts.like');
});

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
