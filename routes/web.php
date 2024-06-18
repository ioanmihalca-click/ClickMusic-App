<?php


use Carbon\Carbon;


use App\Models\User;
use App\Mail\NewComment;
use App\Http\Middleware\Subscribed;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\VideoController;
use App\Notifications\SubscriptionCreated;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Auth\AuthController;
use App\Notifications\AbonamentNouCreatAdmin;
use App\Notifications\NotificareVideoclipNou;
use App\Http\Controllers\SubscriptionController;

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::view('/', 'welcome')->name('welcome');

Route::view('admin', 'admin')
    ->middleware(AdminMiddleware::class)
    ->name('admin');

// Route::get('/', function(){

// trigger mail notification Videoclip Nou
// $users = User::all();
// Notification::send($users, new NotificareVideoclipNou());
// ************************************************

// add delay to queue
    //    $when = Carbon::now()->addSeconds(10);
//    User::find(1)->notify(new AbonamentNouCreatAdmin)->delay($when);

    
//     return view('welcome');


// });

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




    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');


    // Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
    
// Other routes...






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


