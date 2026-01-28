<?php

use App\Http\Controllers\PortofolioController;
use Illuminate\Support\Facades\Route;

// This code makes it go from "routes" to "controllers" (recommended)
Route::get('/', [PortofolioController::class, 'index']);
