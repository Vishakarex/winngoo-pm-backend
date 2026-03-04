<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCredentialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});



Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login-post', [AdminController::class, 'login'])->name('admin.login.submit');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});


Route::post('/admin/change-password', [AdminController::class, 'changePassword']);

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/bulk-delete', [ProjectController::class, 'bulkDelete'])
    ->name('projects.bulkDelete');
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::post('/project-credentials/store', [ProjectCredentialController::class, 'store'])
    ->name('project.credentials.store');


    // routes/web.php
Route::delete('/projects/{project}/credentials/{credential}', [ProjectCredentialController::class, 'destroy'])
    ->name('project.credentials.destroy');

    Route::post('/credential/send-otp', [ProjectCredentialController::class, 'sendOtp']);
Route::post('/credential/verify-otp', [ProjectCredentialController::class, 'verifyOtp']);
// routes/web.php
Route::post('/credential/get-password', [ProjectCredentialController::class, 'getPassword']);