<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@showLoginForm')->name('login');
Route::post('/login/authenticate', 'LoginController@authenticate')->name('login.authenticate');