<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\TaskController;

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthorized user access'], 401);
})->name('login');


// Authentication routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);


// Protected routes (require authentication via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Board and Task routes
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('tasks', TaskController::class);
});
