<?php

use App\Http\Controllers\PortofolioController;
use Illuminate\Support\Facades\Route;

/** This code makes it go from "routes" directly to "view" (not recommended)
Route::get('/', function () {
    // return view('welcome');
    return view('portofolio');
});
*/

// This code makes it go from "routes" to "controllers" (recommended)
Route::get('/', [PortofolioController::class, 'index']);
