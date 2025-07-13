<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ShowTaskController;
use App\Http\Controllers\ShowTaskByIdController;
use App\Http\Controllers\CreateTaskController;
use App\Http\Controllers\MarkAsCompleteTaskController;
use App\Http\Controllers\GetPostsController;
use App\Http\Controllers\NotifyOverdueTasksController;


Route::get('/tasks',ShowTaskController::class);
Route::get('/tasks/{id}', ShowTaskByIdController::class);
Route::post('/tasks',CreateTaskController::class);
Route::put('/tasks/complete/{id}',MarkAsCompleteTaskController::class);
Route::get('/external',GetPostsController::class);

Route::get('/notify-overdue', NotifyOverdueTasksController::class);