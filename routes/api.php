<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// This code to test API Resource + JSON Response
Route::get('/projects', [ProjectController::class, 'index']);
