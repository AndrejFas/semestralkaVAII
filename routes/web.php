<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('home');
Route::get('add', function () {
    return view('add');
})->name('add');
Route::get('documents', function () {
    return view('documents');
})->name('documents');
Route::get('prace', function () {
    return view('prace');
})->name('prace');
