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
use App\Http\Controllers\AbonamentController;
use App\Http\Controllers\Auth\AuthController;
use App\Notifications\AbonamentNouCreatAdmin;
use App\Notifications\NotificareVideoclipNou;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VideoNotificationController;

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
// Route::get('auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::view('/', 'welcome')->name('welcome');

Route::middleware([AdminMiddleware::class])->group(function () { 
    Route::get('/admin', [VideoController::class, 'index'])->name('admin'); // Single route for the admin page
    Route::get('/admin/videos/create', [VideoController::class, 'create'])->name('videos.create'); 
    Route::post('/admin/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::post('/admin/set/featured/video', [VideoController::class, 'setFeaturedVideo'])->name('set.featured.video');
    Route::put('/admin/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
    Route::delete('/admin/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
    Route::post('/send-notification', [VideoNotificationController::class, 'sendNotification'])->name('send.notification');

});

    //trigger mail notification Videoclip Nou
// Route::get('/', function(){


// $users = User::all();
// Notification::send($users, new NotificareVideoclipNou());
// ************************************************

// add delay to queue
    //    $when = Carbon::now()->addSeconds(10);
//    User::find(1)->notify(new AbonamentNouCreatAdmin)->delay($when);

    
//     return view('welcome');


// });

Route::get('abonament', [AbonamentController::class, 'show'])->name('abonament')->middleware('auth');
   

Route::match(['get', 'post'], 'checkout/{plan}', [CheckoutController::class, '__invoke'])
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
    
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
  
     
require __DIR__.'/auth.php';


