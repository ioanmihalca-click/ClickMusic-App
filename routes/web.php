<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;


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
    
  
     
require __DIR__.'/auth.php';


