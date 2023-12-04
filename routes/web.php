<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\YourController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/pridaj', [YourController::class, 'pridaj'])->name('pridaj');
Route::get('/add-user', [YourController::class, 'addUser'])->name('addUser');


