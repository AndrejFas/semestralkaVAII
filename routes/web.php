<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\YourController;
use App\Http\Controllers\PouzivatelController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 
Route::get('/dokumenty', function(){return view('dokumenty');})->name('dokumenty');
Route::get('/prace', function(){return view('prace');})->name('prace');

//admin a veduci
Route::middleware(['auth', 'admin', 'veduci'])->group(function () {
    Route::get('/pridaj', [YourController::class, 'pridaj'])->name('pridaj');
    
});

//admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-user-view', function(){return view('addPouzivatel');})->name('addUserView');
    Route::post('/add-user', [PouzivatelController::class, 'addUser'])->name('addUser');
    Route::delete('/delete-user/{id}', [PouzivatelController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/show-user', [PouzivatelController::class, 'showUser'])->name('showUser');
    Route::get('/edit-user/{id}', [PouzivatelController::class, 'editUser'])->name('editUser');
    Route::put('/refresh-user/{id}', [PouzivatelController::class, 'refreshUser'])->name('refreshUser');
});