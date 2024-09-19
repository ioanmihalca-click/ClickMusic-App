<?php


use Carbon\Carbon;


use App\Models\User;
use App\Mail\NewComment;
use App\Http\Middleware\Subscribed;
use Illuminate\Support\Facades\Route;

use App\Livewire\Blog\Show as BlogShow;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\VideoController;
use App\Livewire\Blog\Index as BlogIndex;
use App\Notifications\SubscriptionCreated;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\AbonamentController;
use App\Http\Controllers\Auth\AuthController;
use App\Notifications\AbonamentNouCreatAdmin;
use App\Notifications\NotificareVideoclipNou;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\VideoNotificationController;
use App\Http\Controllers\SubscriptionSuccessController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PromoUnsubscribeController;

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);



Route::view('/', 'welcome')->name('welcome');

Route::view('/newsletter', 'newsletter')->name('newsletter');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe'); 
Route::get('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');



Route::get('/promo/unsubscribe/{email}', [PromoUnsubscribeController::class, 'unsubscribe'])
    ->name('promo.unsubscribe')
    ->middleware('signed');


Route::get('/blog', BlogIndex::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');

Route::view('magazin', 'magazin')->name('magazin');
Route::get('/album/{album:slug}', [AlbumController::class, 'show'])->name('album.show');
Route::post('/album/{album}/checkout', [AlbumController::class, 'checkout'])->name('album.checkout');
Route::get('/checkout/success', [AlbumController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/album/{album:slug}/download', [AlbumController::class, 'download'])
    ->name('album.download')
    ->middleware('signed');

Route::get('abonament', [AbonamentController::class, 'show'])->name('abonament')->middleware('auth');
Route::get('/subscription/success', SubscriptionSuccessController::class)->name('subscription.success')->middleware('auth');
   

Route::match(['get', 'post'], 'checkout/{plan}', [CheckoutController::class, '__invoke'])
->middleware(['auth', 'verified'])
->name('checkout');



    Route::view('videoclipuri', 'videoclipuri')
    ->middleware([Subscribed::class])
    ->name('videoclipuri');

    Route::get('/videos/{video}', [VideoController::class, 'show'])
    ->name('videos.show')
    ->middleware(['auth']); 

    // Route::view('sustine', 'sustine')
    // ->middleware([Subscribed::class])
    // ->name('sustine');

    Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');




    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancelSubscription'])->name('subscription.cancel');

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
  
//Download mp3

Route::get('/download-mp3/click-ma-racoresc', function () {
    // Calea către fișierul MP3 (adaptează în funcție de locația ta)
    $filePath = 'public/Click_Ma_Racoresc_feat_Mihai_Stanciuc.mp3'; 

    // Verificare dacă utilizatorul este autentificat (membru)
    if (auth()->check()) {
        return Storage::download($filePath, 'Click_Ma_Racoresc_feat_Mihai_Stanciuc.mp3');
    } else {
        // Redirecționare sau mesaj de eroare dacă utilizatorul nu este autentificat
        return redirect()->back()->with('error', 'Trebuie să fii autentificat pentru a descărca acest fișier.');
    }
});

// etc. pentru fiecare MP3 




//Pagina de ascultare si download mp3

Route::get('/song', function () {
    $songTitle = ""; // Titlul piesei
    $songUrl = Storage::url('songs\Click_Ma_Racoresc_feat_Mihai_Stanciuc.mp3'); // Calea către fișierul audio
    $coverUrl = Storage::url('songs\Ma racoresc Thumbnail Optimizat.jpg'); // Calea către imaginea de copertă

    return view('songs.song', compact('songTitle', 'songUrl', 'coverUrl'));
})->name('song.show');




     
require __DIR__.'/auth.php';


//Preview PromoMail

// use App\Models\PromoEmail;
// use App\Notifications\PromoEmailNotification;

// Route::get('/preview-promo-email', function () {
//     $promoEmail = PromoEmail::first(); // Or any other way to get a PromoEmail instance
//     $songUrl = 'http://127.0.0.1:8000/song';
//     $downloadUrl = 'http://127.0.0.1:8000/song';
//     $imageUrl = 'https://res.cloudinary.com/dpxess5iw/image/upload/v1721219233/Ma_racoresc_Thumbnail_Optimizat_vsotpf.jpg';
//     $subject = 'Ma racoresc';

//     return (new PromoEmailNotification($promoEmail, $songUrl, $downloadUrl, $imageUrl, $subject))
//         ->toMail($promoEmail);
// });

//Preview Newsletter
// use App\Models\Newsletter; 
// use App\Notifications\NewsletterNotification;

// Route::get('/preview-newsletter-email', function () {
//     $newsletter = Newsletter::find(1); // Or any other way to get a Newsletter instance
//     $imageUrl = 'https://res.cloudinary.com/dpxess5iw/image/upload/v1721219233/Ma_racoresc_Thumbnail_Optimizat_vsotpf.jpg'; // Replace with your actual image path or URL
//     $url = 'https://youtu.be/8WPtQ5P-PVU?si=qjmZIx4GipQL1CiM'; // Replace with the actual URL you want to link to

//     return (new NewsletterNotification($newsletter, $imageUrl, $url))
//         ->toMail($newsletter);
// });

