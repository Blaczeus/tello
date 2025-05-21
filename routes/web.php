<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Models\Task;
use Illuminate\Http\Request;


Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('home');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::resource('tasks', TaskController::class)->middleware('auth');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus'); 


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
