<?php

use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
// api 
use App\Http\Controllers\api\ApiContentController;
use App\Http\Controllers\ChatController;

// user
Route::group(['middleware' => 'guest'], function () {
    // bagian api
    Route::get('/api/content', [ApiContentController::class, 'index'])->name('index');
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/login', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('register', [WelcomeController::class, 'register'])->name('register');
    Route::post('process-register', [WelcomeController::class, 'processRegister'])->name('processRegister');
    Route::post('login', [WelcomeController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [WelcomeController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::delete('/content/{id}', [ContentController::class, 'destroy'])->name('content.delete');
    // like ini wajib menggunakan {id}
    Route::get('like', [LikeController::class, 'index'])->name('like.index');
    Route::post('/like/{id}', [ContentController::class, 'like'])->name('like');
    
    Route::post('/content/{contentId}/comment', [ContentController::class, 'comment'])->name('comment')->middleware('auth');
    Route::delete('/comment/{id}', [ContentController::class, 'deleteComment'])->name('comments.delete')->middleware('auth');
    
    Route::delete('/comments/delete/{content}', [ContentController::class, 'deleteCommentall'])->name('comments.deleteCommentall');
    
    Route::resource('/profile', ContentController::class);
    Route::get('/content/{id}/edit', [ContentController::class, 'edit'])->name('content.edit');
    Route::put('/content/{id}', [ContentController::class, 'update'])->name('content.update');
    
    // fitur melihat profil orang lain
    Route::get('/profile-{username}', [ContentController::class, 'showprofile'])->name('content.showprofile');
    // chat
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
});

// Rute admin
Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin.guest'], function() {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login'); 
        Route::post('process-login', [AdminLoginController::class, 'login'])->name('admin.process.login'); 
    });

    Route::group(['middleware' => 'admin.auth'], function() {
        Route::get('home', [AdminHomeController::class, 'index'])->name('admin.home');
        Route::delete('/content/{id}', [AdminHomeController::class, 'destroy'])->name('admin.content.delete');
        Route::get('user', [AdminUserController::class, 'index'])->name('admin.user');
        Route::delete('/user/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.delete');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        // fitur centang biru
        Route::post('admin/user/verify/{user}', [AdminUserController::class, 'verify'])->name('admin.user.verify');
    });
});
