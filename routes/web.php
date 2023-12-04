<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// ... other routes

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
