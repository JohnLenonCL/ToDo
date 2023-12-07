<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
// routes/web.php



Route::middleware(['auth', 'admin_access'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/delete/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});


Route::middleware(['auth', 'admin_access'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});


Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

Auth::routes();

Route::resource('tasks', TaskController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

// web.php

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

Route::put('/tasks/{task}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
// web.php

Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

