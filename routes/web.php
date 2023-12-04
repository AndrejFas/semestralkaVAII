<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class,'login'])->name('login');
Route::get('add', [MainController::class,'add'])->name('add');
Route::get('documents', [MainController::class,'documents'])->name('documents');
Route::get('prace', [MainController::class,'prace'])->name('prace');
