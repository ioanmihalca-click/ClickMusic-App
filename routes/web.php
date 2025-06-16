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

// Rute pentru haine 
Route::get('/haina/{haina:slug}', [App\Http\Controllers\HainaController::class, 'show'])->name('haina.show');
Route::post('/haina/{haina}/checkout', [App\Http\Controllers\HainaController::class, 'checkout'])->name('haina.checkout');
Route::get('/haina/checkout/success', [App\Http\Controllers\HainaController::class, 'checkoutSuccess'])->name('haina.checkout.success');

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

    // Thread management routes
    Route::delete('/discutii/{thread}/delete', [App\Http\Controllers\ForumThreadsController::class, 'destroy'])->name('forum.threads.destroy');
    Route::get('/discutii/{thread}/edit', [App\Http\Controllers\ForumThreadsController::class, 'edit'])->name('forum.threads.edit');
    Route::put('/discutii/{thread}', [App\Http\Controllers\ForumThreadsController::class, 'update'])->name('forum.threads.update');

    // Reply management routes
    Route::delete('/raspunsuri/{reply}/delete', [App\Http\Controllers\ForumRepliesController::class, 'destroy'])->name('forum.replies.destroy');
    Route::get('/raspunsuri/{reply}/edit', [App\Http\Controllers\ForumRepliesController::class, 'edit'])->name('forum.replies.edit');
    Route::put('/raspunsuri/{reply}', [App\Http\Controllers\ForumRepliesController::class, 'update'])->name('forum.replies.update');
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
    ->name('profile.edit');

Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar')->middleware('auth');
Route::get('/profile/avatar/crop', [ProfileController::class, 'showCropForm'])->name('profile.avatar.crop')->middleware('auth');
Route::post('/profile/avatar/crop', [ProfileController::class, 'cropAvatar'])->name('profile.avatar.crop.save')->middleware('auth');



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
