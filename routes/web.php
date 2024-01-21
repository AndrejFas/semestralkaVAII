<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PouzivatelController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dokumenty', function(){return view('dokumenty');})->name('dokumenty');
    Route::get('/prace', [JobController::class, 'showJobView'])->name('prace');
    Route::post('/jobs/filter', [JobController::class, 'filterJobs'])->name('job.filter');
    Route::get('/job-details/{id}', [JobController::class, 'jobDetails'])->name('jobDetails');
    Route::get('/jobs/{jobId}', [JobController::class, 'showJobCard'])->name('jobs.show');
});



//student
Route::middleware(['auth', 'student'])->group(function () {

    Route::post('/apply', [JobController::class, 'apply'])->name('apply');
    Route::post('/withdraw', [JobController::class, 'withdraw'])->name('withdraw');

    Route::get('/priradenaPraca', function(){return view('priradenaPraca');})->name('priradenaPraca');

    Route::get('/edit-files', [FileController::class, 'editFilesView'])->name('editFiles');

    Route::post('/edit-pdf-text', [FileController::class, 'editPdfText'])->name('editPdfText');
    Route::get('/download-pdf-text/{id}', [FileController::class, 'downloadPdfText'])->name('downloadPdfText');
    Route::post('/delete-pdf-text/{id}', [FileController::class, 'deletePdfText'])->name('deletePdfText');

    Route::post('/edit-zip-prilohy', [FileController::class, 'editZipPrilohy'])->name('editZipPrilohy');
    Route::get('/download-zip-prilohy/{id}', [FileController::class, 'downloadZipPrilohy'])->name('downloadZipPrilohy');
    Route::post('/delete-zip-prilohy/{id}', [FileController::class, 'deleteZipPrilohy'])->name('deleteZipPrilohy');

    Route::post('/edit-pdf-originalita', [FileController::class, 'editPdfOriginalita'])->name('editPdfOriginalita');
    Route::get('/download-pdf-originalita/{id}', [FileController::class, 'downloadPdfOriginalita'])->name('downloadPdfOriginalita');
    Route::post('/delete-pdf-originalita/{id}', [FileController::class, 'deletePdfOriginalita'])->name('deletePdfOriginalita');
});

//veduci
Route::middleware(['auth', 'veduci'])->group(function () {
    Route::get('/add-job-view', [JobController::class, 'showAddPracuView'])->name('addJobView');
    Route::post('/add-job', [JobController::class, 'addJob'])->name('addJob');

    Route::delete('/delete-job/{id}', [JobController::class, 'deleteJob'])->name('deleteJob');

    Route::get('/edit-job/{id}', [JobController::class, 'editJob'])->name('editJob');
    Route::put('/refresh-job/{id}', [JobController::class, 'refreshJob'])->name('refreshJob');

    Route::post('/assign-job', [JobController::class,'assignJob'])->name('assignJob');
    Route::post('/cancelAssignment', [JobController::class,'cancelAssignment'])->name('cancelAssignment');
});

//admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/add-job-view-admin', [JobController::class, 'showAddPracuView'])->name('addJobViewAdmin');
    Route::post('/add-job-admin', [JobController::class, 'addJob'])->name('addJobAdmin');
    Route::delete('/delete-job-admin/{id}', [JobController::class, 'deleteJob'])->name('deleteJobAdmin');

    Route::get('/edit-job-admin/{id}', [JobController::class, 'editJob'])->name('editJobAdmin');
    Route::put('/refresh-job-admin/{id}', [JobController::class, 'refreshJob'])->name('refreshJobAdmin');

    Route::post('/assign-job-admin', [JobController::class,'assignJob'])->name('assignJob');
    Route::post('/cancelAssignment-admin', [JobController::class,'cancelAssignment'])->name('cancelAssignmentA');


    Route::get('/add-user-view', function(){return view('addPouzivatel');})->name('addUserView');
    Route::post('/add-user', [PouzivatelController::class, 'addUser'])->name('addUser');
    Route::delete('/delete-user/{id}', [PouzivatelController::class, 'deleteUser'])->name('deleteUser');
    Route::get('/show-user', [PouzivatelController::class, 'showUser'])->name('showUser');
    Route::get('/edit-user/{id}', [PouzivatelController::class, 'editUser'])->name('editUser');
    Route::put('/refresh-user/{id}', [PouzivatelController::class, 'refreshUser'])->name('refreshUser');

    Route::get('/file-view-admin', [FileController::class, 'showFiles'])->name('showFiles');

    Route::get('/download-pdf-text-admin/{id}', [FileController::class, 'downloadPdfText'])->name('downloadPdfTextAdmin');
    Route::post('/delete-pdf-text-admin/{id}', [FileController::class, 'deletePdfText'])->name('deletePdfTextAdmin');

    Route::get('/download-zip-prilohy-admin/{id}', [FileController::class, 'downloadZipPrilohy'])->name('downloadZipPrilohyAdmin');
    Route::post('/delete-zip-prilohy-admin/{id}', [FileController::class, 'deleteZipPrilohy'])->name('deleteZipPrilohyAdmin');

    Route::get('/download-pdf-originalita-admin/{id}', [FileController::class, 'downloadPdfOriginalita'])->name('downloadPdfOriginalitaAdmin');
    Route::post('/delete-pdf-originalita-admin/{id}', [FileController::class, 'deletePdfOriginalita'])->name('deletePdfOriginalitaAdmin');
});



