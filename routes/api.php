<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConstructorSearchController;
use App\Http\Controllers\WorkSearchController;
use App\Http\Controllers\ConstructionInquiryController;
use App\Http\Controllers\SkillSearchController;

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

// Constructor search API
Route::get('/search-constructors', [ConstructorSearchController::class, 'search']);

// Work search API
Route::get('/search-works', [WorkSearchController::class, 'search']);

// Skill search API
Route::get('/search-skills', [SkillSearchController::class, 'search']);

// Construction Inquiry API
Route::post('/v1/construction/inquiry', [ConstructionInquiryController::class, 'inquiry']); 