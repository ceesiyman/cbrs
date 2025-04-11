<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ConstructorSearchController;
use App\Http\Controllers\ConstructorProfileController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\WorkSearchController;

// Set home as the landing page
Route::get('/', function () {
    return view('home');
});

// Redirect /home to / to avoid duplicate content
Route::get('/home', function () {
    return redirect('/');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Work routes
    Route::get('/works', [WorkController::class, 'index'])->name('work.index');
    Route::get('/work/create', [WorkController::class, 'create'])->name('work.create');
    Route::post('/work', [WorkController::class, 'store'])->name('work.store');
    Route::get('/work/{work}', [WorkController::class, 'show'])->name('work.show');
    Route::get('/works/unassigned', [WorkController::class, 'unassigned'])->name('work.unassigned');
    Route::get('/work/{work}/bid', [WorkController::class, 'bid'])->name('work.bid');
    Route::post('/work/{work}/bid', [WorkController::class, 'storeBid'])->name('work.bid.store');
    Route::post('/work/{work}/assign', [WorkController::class, 'assign'])->name('work.assign');
    Route::get('/top-works', [WorkController::class, 'topWorks'])->name('works.top');
    Route::patch('/works/{work}/status', [WorkController::class, 'updateStatus'])
        ->name('work.update-status');

    // Profile routes
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');
    Route::post('/experience', [ExperienceController::class, 'store'])->name('experience.store');
    Route::post('/profile/projects', [ProjectController::class, 'store'])->name('projects.store');

    // Add this new route
    Route::get('/bids', [BidController::class, 'index'])->name('bids.index');

    // Add these new routes
    Route::get('/work/{work}/bid/{bid}/edit', [WorkController::class, 'editBid'])->name('work.bid.edit');
    Route::patch('/work/{work}/bid/{bid}', [WorkController::class, 'updateBid'])->name('work.bid.update');
});

Route::get('/hire-constructor', function () {
    return view('hire-constructor');
})->name('hire-constructor');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Constructor routes
Route::get('/api/search-constructors', [ConstructorSearchController::class, 'search']);
Route::get('/constructors/{id}', [ConstructorProfileController::class, 'show'])->name('constructor.profile');

// Add your other routes below this line
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Add this with your other web routes
Route::get('/api/search-works', [WorkSearchController::class, 'search']);

Route::get('/recent-works', [WorkController::class, 'recentWorks'])->name('recent-works');

Route::get('/works/skill/{skill}', [WorkController::class, 'worksBySkill'])->name('works.by.skill');
Route::get('/skills/all', [WorkController::class, 'allSkills'])->name('skills.all');

Route::get('/constructors', [App\Http\Controllers\ConstructorController::class, 'index'])
    ->name('constructors.index');
Route::get('/constructor/{id}', [App\Http\Controllers\ConstructorProfileController::class, 'show'])
    ->name('constructor.profile');

    Route::get('/hire-constructor/{constructor}',[WorkController::class, 'showHireForm'])->name('hire.constructor.form');
    Route::post('/hire-constructor/{constructor}', [WorkController::class, 'sendHireRequest'])->name('hire.constructor.send');   
    Route::post('/work/{work}/respond-hire-request', [WorkController::class, 'respondToHireRequest'])
    ->name('work.respond-hire-request');