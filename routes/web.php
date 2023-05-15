<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\CategoryController;
use App\Http\Controllers\v1\PostController as v1PostController;
use App\Http\Controllers\v1\TagController;
use App\Http\Controllers\v1\DashboardController;
use App\Http\Controllers\v1\SettingController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SearchController;



Route::get('/',  [HomeController::class, 'index'])->name('home');

Route::get('posts',  [PostController::class, 'index'])->name('post.index');
Route::get('posts/{slug}',  [PostController::class, 'details'])->name('post.details');

Route::get('category/{slug}',  [PostController::class, 'postByCategory'])->name('category.posts');
Route::get('tag/{slug}',  [PostController::class, 'postByTag'])->name('tag.posts');

Route::get('profile/{username}',  [AuthorController::class, 'profile'])->name('author.profile');

Route::get('/search',[SearchController::class, 'search'])->name('search');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::put('profile-update', [SettingController::class, 'updateProfile'])->name('profile.update');
    Route::put('socialnetwork-update', [SettingController::class, 'updateSocialnetwork'])->name('socialnetwork.update');

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', v1PostController::class);
    Route::resource('tags', TagController::class);

    Route::get('/pending/post', [v1PostController::class, 'pending'])->name('post.pending');
    Route::put('/post/{id}/approve', [v1PostController::class, 'approval'])->name('post.approve');
});



Auth::routes();



