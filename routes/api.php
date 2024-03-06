<?php

use Api\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('tasks')
    ->name('tasks.')
    ->group(function () {
        Route::post('index', [TaskController::class, 'index'])->name('index');
        Route::post('store', [TaskController::class, 'store'])->name('store');
        Route::post('{task}', [TaskController::class, 'getByUuid'])->name('get-by-uuid')->whereUlid('get-by-uuid');
        Route::post('{task}/update', [TaskController::class, 'update'])->name('update')->whereUlid('task');
        Route::delete('{task}', [TaskController::class, 'destroy'])->name('destroy')->whereUlid('task');
    });
