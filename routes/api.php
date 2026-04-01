<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// This code to test API Resource + JSON Response
// Route::get('/projects', [ProjectController::class, 'index']);

// This code to access API resource without login
// Route::apiResource('projects', ProjectController::class);

Route::prefix('v1')->group(function () {

    // This code to access API resource through the register, login, and logout features
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::middleware(['auth:sanctum', 'admin', 'throttle:60,1'])->group(function () {
        Route::apiResource('projects', ProjectController::class);
    });

});
