<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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

Route::get('/', [UserController::class,'home'])->name('home');

Route::get('/register',[UserController::class,'register'])->name('register');

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::get('/profile', [UserController::class,'profile'])->name('profile')->middleware('auth');

Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('{user:username}/posts/{post}',[PostController::class,'show'])->name('posts.show');

Route::get('/{user:username}',[PostController::class,'index'])->name('posts.index');

Route::get('/images/purge',[ImageController::class,'purge'])->name('images.purge');

Route::post('/register',[UserController::class,'store']);

Route::post('/login',[LoginController::class,'login']);

Route::post('/images/post',[ImageController::class,'store'])->name('images.store.post');

Route::post('/images/profile',[ImageController::class,'storeProfile'])->name('images.store.profile');

Route::post('/images/banner',[ImageController::class,'storeBanner'])->name('images.store.banner');

Route::post('/post',[PostController::class,'store'])->name('post.store');

Route::post('/comment',[CommentController::class,'store'])->name('comments.store');

Route::post('/{post}/like',[LikeController::class,'switchLike'])->name('posts.like.switch');

Route::post('{user}/follow',[FollowController::class,'store'])->name('users.follow.store');

Route::post('/find',[UserController::class,'find'])->name('users.find');

Route::put('/register',[UserController::class,'update'])->name('update');

Route::put('/dashboard',[UserController::class,'updateBio'])->name('updateBio');

Route::delete('/destroy',[PostController::class,'destroy'])->name('posts.destroy')->middleware('auth');

Route::delete('{user}/unfollow',[FollowController::class,'destroy'])->name('users.follow.destroy');

Route::delete('/destroy/user' ,[UserController::class,'destroy'])->name('remove')->middleware('auth');
