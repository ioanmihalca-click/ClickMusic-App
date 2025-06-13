<?php


use Carbon\Carbon;


use App\Models\User;
use App\Mail\NewComment;
use App\Livewire\Contact;
use App\Livewire\Magazin;

use App\Livewire\Welcome;
use App\Livewire\AccesPremium;
use App\Http\Middleware\Subscribed;
use App\Livewire\ElectronicPressKit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Blog\Show as BlogShow;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\VideoController;
use App\Livewire\Blog\Index as BlogIndex;
use App\Notifications\SubscriptionCreated;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\AbonamentController;
use App\Http\Controllers\Auth\AuthController;
use App\Notifications\AbonamentNouCreatAdmin;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PromoUnsubscribeController;
use App\Http\Controllers\VideoNotificationController;
use App\Http\Controllers\SubscriptionSuccessController;

Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::get('/', Welcome::class)->name('home');

Route::get('/press', ElectronicPressKit::class)->name('electronic-press-kit');

Route::get('magazin', Magazin::class)->name('magazin');
Route::get('/album/{album:slug}', [AlbumController::class, 'show'])->name('album.show');
Route::post('/album/{album}/checkout', [AlbumController::class, 'checkout'])->name('album.checkout');
Route::get('/checkout/success', [AlbumController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/album/{album:slug}/download', [AlbumController::class, 'download'])
    ->name('album.download')
    ->middleware('signed');

Route::get('/blog', BlogIndex::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');

Route::get('/accespremium', AccesPremium::class)->name('accespremium');


// Newsletter functionality - extended
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Rute noi pentru gestionarea avansată a newsletter-ului
Route::post('/newsletter/resubscribe', [NewsletterController::class, 'resubscribe'])->name('newsletter.resubscribe');
Route::get('/newsletter/status', [NewsletterController::class, 'status'])->name('newsletter.status');
Route::get('/newsletter/stats', [NewsletterController::class, 'stats'])->name('newsletter.stats');

// Rută pentru utilizatorii autentificați să își gestioneze abonarea
Route::middleware(['auth'])->group(function () {
    Route::post('/profile/newsletter-toggle', function (Request $request) {
        $user = Auth::user();

        if ($user->isSubscribedToNewsletter()) {
            $user->unsubscribeFromNewsletter();
            return redirect()->back()->with('success', 'Te-ai dezabonat de la newsletter.');
        } else {
            $user->subscribeToNewsletter();
            return redirect()->back()->with('success', 'Te-ai abonat la newsletter.');
        }
    })->name('profile.newsletter.toggle');
});



Route::get('/promo/unsubscribe/{email}', [PromoUnsubscribeController::class, 'unsubscribe'])
    ->name('promo.unsubscribe')
    ->middleware('signed');



Route::get('abonament', [AbonamentController::class, 'show'])->name('abonament')->middleware('auth');
Route::get('/subscription/success', SubscriptionSuccessController::class)->name('subscription.success')->middleware('auth');


Route::match(['get', 'post'], 'checkout/{plan}', [CheckoutController::class, '__invoke'])
    ->middleware(['auth', 'verified'])
    ->name('checkout');


Route::prefix('comunitate')->middleware(['auth'])->group(function () {
    Route::get('/', App\Livewire\Forum\ForumIndex::class)->name('forum.index');
    Route::get('/categorii/{category:slug}', App\Livewire\Forum\CategoryShow::class)->name('forum.categories.show');
    Route::get('/discutii/creare', App\Livewire\Forum\ThreadCreate::class)->name('forum.threads.create');
    Route::get('/discutii/{thread:slug}', App\Livewire\Forum\ThreadShow::class)->name('forum.threads.show');
});

Route::view('videoclipuri', 'videoclipuri')
    ->middleware([Subscribed::class])
    ->name('videoclipuri');

Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show')

    ->middleware(['auth']);

// Secure video streaming route (authenticated users only)
Route::get('/videos/stream/{id}', [VideoController::class, 'stream'])->name('videos.stream')

    ->middleware(['auth']);

// Route::view('sustine', 'sustine')
// ->middleware([Subscribed::class])
// ->name('sustine');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar')->middleware('auth');



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

Route::get('/contact', Contact::class)->name('contact');

require __DIR__ . '/auth.php';
