<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/blogs/{slug}', [SiteController::class, 'blogDetail'])->name('blogs.detail');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginCheck'])->name('loginCheck');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('dashboard')->group(function () {


    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');
    Route::resource('category', CategoryController::class)->only(['store', 'index', 'destroy', 'update']);
    Route::resource('blog', BlogController::class);
});
