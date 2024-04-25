<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/videos', [VideoController::class, 'getVideos']);

  
     
require __DIR__.'/auth.php';


