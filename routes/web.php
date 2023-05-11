<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Author\PostController as AuthorPostController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;



Route::get('/',  [HomeController::class, 'index'])->name('home');

Route::get('posts',  [PostController::class, 'index'])->name('post.index');
Route::get('posts/{slug}',  [PostController::class, 'details'])->name('post.details');

Route::get('category/{slug}',  [PostController::class, 'postByCategory'])->name('category.posts');
Route::get('tag/{slug}',  [PostController::class, 'postByTag'])->name('tag.posts');

Route::get('profile/{username}',  [AuthorController::class, 'profile'])->name('author.profile');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::put('profile-update', [SettingController::class, 'updateProfile'])->name('profile.update');
    Route::put('password-update', [SettingController::class, 'updatePassword'])->name('password.update');

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', AdminPostController::class);
    Route::resource('tags', TagController::class);

    Route::get('/pending/post', [AdminPostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve', [AdminPostController::class, 'approval'])->name('post.approve');
});

Route::group(['prefix' => 'author',  'middleware' => 'auth'], function() { 

    Route::get('dashboard', [AuthorDashboardController::class, 'index'])->name('author.dashboard');

    Route::get('settings', [SettingController::class, 'index'])->name('author.settings');
    Route::put('profile-update', [SettingController::class, 'updateProfile'])->name('profile.update');
    Route::put('password-update', [SettingController::class, 'updatePassword'])->name('password.update');

    Route::resource('posts', AuthorPostController::class);
});


Auth::routes();



