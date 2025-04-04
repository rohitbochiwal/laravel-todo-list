<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::get('/tasks/show-all', [TaskController::class, 'showAll'])->name('tasks.showAll');
