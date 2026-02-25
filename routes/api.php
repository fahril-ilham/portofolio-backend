<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// This code to test API Resource + JSON Response
// Route::get('/projects', [ProjectController::class, 'index']);

// This code to access API resource
Route::apiResource('projects', ProjectController::class);

// This code to access register, login, and logout
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('projects', ProjectController::class);
});
