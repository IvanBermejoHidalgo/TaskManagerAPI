<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'getTasks']);
Route::get('/tasks/{id}', [TaskController::class, 'getTaskById']);
Route::post('/tasks', [TaskController::class, 'createTask']);
Route::post('/tasks/complete/{id}', [TaskController::class, 'taskCompleted']);
