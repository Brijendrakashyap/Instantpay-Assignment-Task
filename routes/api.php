<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

    // User APIs
    Route::apiResource('users', UserController::class);

    // Board and Task routes
    Route::apiResource('boards', BoardController::class);
    Route::apiResource('tasks', TaskController::class);
});
