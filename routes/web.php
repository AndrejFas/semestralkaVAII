<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\YourController;
use App\Http\Controllers\PouzivatelController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/pridaj', [YourController::class, 'pridaj'])->name('pridaj');

Route::post('/pridaj-pouzivatela', [PouzivatelController::class, 'pridajPouzivatela'])->name('pridaj.pouzivatela');
Route::get('/pridajUser', function(){return view('addPouzivatel');})->name('pridajuser');

Route::delete('/odstran-uzivatele/{id}', [PouzivatelController::class, 'odstranUzivatele'])->name('odstranUzivatele');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/zobraz-uzivatele', [PouzivatelController::class, 'zobrazUzivatele'])->name('zobrazUzivatele');
});