<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// This code to test API Resource + JSON Response
// Route::get('/projects', [ProjectController::class, 'index']);

// This code to access API resource without login
// Route::apiResource('projects', ProjectController::class);

// This code to access API resource through the register, login, and logout features
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('projects', ProjectController::class);
});
