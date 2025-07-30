<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

# Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('checklogin')->group(function () { 
    # Dashboard
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    
    # User
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/create', [UserController::class, 'create'])->name('userCreate');
    Route::post('user/store', [UserController::class, 'store'])->name('userStore');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
    Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('userDelete');
    
    # Tugas
    Route::get('tugas', [TugasController::class, 'index'])->name('tugas');
});