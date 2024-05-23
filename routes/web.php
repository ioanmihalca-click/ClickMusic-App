<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

use App\Http\Controllers\Auth\AuthController;

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::view('magazin', 'magazin')
    ->middleware(['auth', 'verified'])
    ->name('magazin');

    Route::view('sustine', 'sustine')
    ->middleware(['auth', 'verified'])
    ->name('sustine');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


    Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');

   // Define route for privacy policy page
Route::get('/politica-de-confidentialitate', function () {
    return view('politica-de-confidentialitate');
})->name('privacy-policy');

    
  
     
require __DIR__.'/auth.php';


