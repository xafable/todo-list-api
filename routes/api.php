<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(\App\Http\Controllers\TodoListController::class)->group(function () {
    Route::get('/lists', 'get');
    Route::post('/lists', 'store');
});

Route::controller(\App\Http\Controllers\TaskController::class)->group(function () {
    Route::get('/lists/{listId}/tasks', 'get');
    Route::post('/tasks', 'store');
    Route::post('/tasks/{id}', 'update');
    Route::delete('/tasks/{id}', 'destroy');
});


