<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::middleware('isLogin')->group(function () {
    # Auth
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginProcess'])->name('loginProcess');
    
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('checklogin')->group(function () { 
    # Dashboard
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    
    # Tugas
    Route::get('tugas', [TugasController::class, 'index'])->name('tugas');
    Route::get('tugas/pdf', [TugasController::class, 'pdf'])->name('tugasPdf');
    
        Route::middleware('isAdmin')->group(function () {
            # User  
            Route::get('user', [UserController::class, 'index'])->name('user');
            Route::get('user/create', [UserController::class, 'create'])->name('userCreate');
            Route::post('user/store', [UserController::class, 'store'])->name('userStore');
            Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
            Route::post('user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
            Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('userDelete');
            Route::get('user/excel', [UserController::class, 'excel'])->name('userExcel');
            Route::get('user/pdf', [UserController::class, 'pdf'])->name('userPdf');
            
            # Tugas
            Route::get('tugas/create', [TugasController::class, 'create'])->name('tugasCreate');
            Route::post('tugas/store', [TugasController::class, 'store'])->name('tugasStore');
            Route::get('tugas/edit/{id}', [TugasController::class, 'edit'])->name('tugasEdit');
            Route::post('tugas/update/{id}', [TugasController::class, 'update'])->name('tugasUpdate');
            Route::delete('tugas/delete/{id}', [TugasController::class, 'delete'])->name('tugasDelete');
            Route::get('tugas/excel', [TugasController::class, 'excel'])->name('tugasExcel');
           
        });
         
});