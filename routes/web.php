<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});
Route::resource('category', CategoryController::class)->only(['store','index','destroy','update']);
Route::resource('blog', BlogController::class);
