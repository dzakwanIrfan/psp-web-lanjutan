<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'active' => 'home',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'name' => 'Dzakwan Irfan Ramdhani',
        'url' => 'img/fotodzakwan.png',
        'bio' => 'Saya adalah mahasiswa informatika angkatan 2022 semester 5',
        'spesialis' => ['Software Developer', 'Designer'],
        'active' => 'about',
    ]);
});

Route::get('/blog', function () {
    $posts = Post::all();
    return view('blog', [
        'active' => 'blog',
        'posts' => $posts,
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/post/create', [PostController::class, 'create']);
    Route::post('/post', [PostController::class, 'store']);
    Route::get('/post/{post}/edit', [PostController::class, 'edit']);
    Route::post('/post/{post}/update', [PostController::class, 'update']);
    Route::delete('/post/{post}', [PostController::class, 'destroy']);

    Route::get('/category', [CategoryController::class, 'index']);
});

require __DIR__.'/auth.php';
