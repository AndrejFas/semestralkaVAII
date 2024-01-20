<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PouzivatelController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 
Route::get('/dokumenty', function(){return view('dokumenty');})->name('dokumenty');
Route::get('/prace', [JobController::class, 'showJobView'])->name('prace');
Route::post('/jobs/filter', [JobController::class, 'filterFilter'])->name('job.filter');
Route::get('/job-details/{id}', [JobController::class, 'jobDetails'])->name('jobDetails');



//student
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/edit-files', [FileController::class, 'editFilesView'])->name('editFiles');

    Route::post('/edit-pdf-text', [FileController::class, 'editPdfText'])->name('editPdfText');
    Route::get('/download-pdf-text', [FileController::class, 'downloadPdfText'])->name('downloadPdfText');
    Route::post('/delete-pdf-text', [FileController::class, 'deletePdfText'])->name('deletePdfText');

    Route::post('/edit-zip-prilohy', [FileController::class, 'editZipPrilohy'])->name('editZipPrilohy');
    Route::get('/download-zip-prilohy', [FileController::class, 'downloadZipPrilohy'])->name('downloadZipPrilohy');
    Route::post('/delete-zip-prilohy', [FileController::class, 'deleteZipPrilohy'])->name('deleteZipPrilohy');

    Route::post('/edit-pdf-originalita', [FileController::class, 'editPdfOriginalita'])->name('editPdfOriginalita');
    Route::get('/download-pdf-originalita', [FileController::class, 'downloadPdfOriginalita'])->name('downloadPdfOriginalita');
    Route::post('/delete-pdf-originalita', [FileController::class, 'deletePdfOriginalita'])->name('deletePdfOriginalita');
});

//admin a veduci
Route::middleware(['auth', 'admin', 'veduci'])->group(function () {
    Route::get('/add-job-view', function(){return view('addPracu');})->name('addJobView');
    Route::post('/add-job', [JobController::class, 'addJob'])->name('addJob');
    Route::delete('/delete-job/{id}', [JobController::class, 'deleteJob'])->name('deleteJob');
    Route::get('/show-job', [JobController::class, 'showJob'])->name('showJob');
    Route::get('/edit-job/{id}', [JobController::class, 'editJob'])->name('editJob');
    Route::put('/refresh-job/{id}', [JobController::class, 'refreshJob'])->name('refreshJob');
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



