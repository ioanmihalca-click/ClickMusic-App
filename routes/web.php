<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\Subscribed;
use Illuminate\Http\Request;

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::view('/', 'welcome');

Route::view('abonament', 'abonament')
    ->middleware(['auth', 'verified'])
    ->name('abonament');

    Route::get('checkout/{plan?}', CheckoutController::class)
    ->middleware(['auth', 'verified'])
    ->name('checkout');



    Route::view('videoclipuri', 'videoclipuri')
    ->middleware([Subscribed::class])
    ->name('videoclipuri');


    Route::view('magazin', 'magazin')
    ->middleware([Subscribed::class])
    ->name('magazin');

    Route::view('sustine', 'sustine')
    ->middleware([Subscribed::class])
    ->name('sustine');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



    Route::middleware(['auth'])->group(function () {
        Route::post('/cancel-subscription', function (Request $request) {
            $request->user()->subscription()->cancel();
            return back()->with('success', 'Abonamentul a fost anulat cu succes!');
        })->name('cancelSubscription');
    
        Route::get('/abonament', function (Request $request) {
            // Redirect către pagina 'videoclipuri' după interacțiunea cu portalul de gestionare a abonamentului
            return $request->user()->redirectToBillingPortal(route('videoclipuri')); 
        })->name('abonament');
    });


    Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');

    Route::get('/videos/share/{id}', [VideoController::class, 'share'])->name('videos.share');

   // Define route for privacy policy page
Route::get('/politica-de-confidentialitate', function () {
    return view('politica-de-confidentialitate');
})->name('privacy-policy');

// Definire rută pentru pagina de Termeni și Condiții
Route::get('/termeni-si-conditii', function () {
    return view('termeni-si-conditii');
})->name('terms-of-service');
    
  
     
require __DIR__.'/auth.php';


