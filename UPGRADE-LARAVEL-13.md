# Upgrade Laravel 12 -> 13

Data: 2026-03-26

## Versiuni actualizate

| Pachet | Inainte | Dupa |
|--------|---------|------|
| laravel/framework | 12.51.0 | 13.2.0 |
| livewire/livewire | 3.7.10 | 4.2.1 |
| filament/filament | 3.3.48 | 5.4.1 |
| laravel/cashier | 15.7.1 | 16.5.0 |
| barryvdh/laravel-debugbar | 3.16.5 | 4.1.3 |
| laravel/tinker | 2.11.1 | 3.0.0 |
| phpunit/phpunit | 11.x | 12.0 |
| spatie/laravel-ignition | 2.10.0 | 2.12.0 |
| nunomaduro/collision | 8.8.3 | 8.9.1 |

## Pachete inlocuite

| Vechi | Nou | Motiv |
|-------|-----|-------|
| mews/purifier ^3.4 | stevebauman/purify ^6.0 | mews/purifier nu suporta Laravel 13 (abandonat) |
| livewire/volt ^1.0 | (sters) | Livewire 4 suporta nativ view-based components |
| doctrine/dbal ^4.2 | (sters) | Filament 5 nu mai necesita doctrine/dbal |

## Modificari in cod

### 1. composer.json
- Versiuni actualizate (vezi tabelele de mai sus)
- Sters: `illuminate/console`, `doctrine/dbal`, `livewire/volt`, `mews/purifier`
- Adaugat: `stevebauman/purify`

### 2. Laravel 13 - CSRF Middleware rename
**Fisier:** `app/Providers/Filament/AdminPanelProvider.php`
- `Illuminate\Foundation\Http\Middleware\VerifyCsrfToken` -> `Illuminate\Foundation\Http\Middleware\PreventRequestForgery`

### 3. Laravel 13 - Fix bug Post model
**Fisier:** `app/Models/Post.php`
- `booted()` apela gresit `parent::boot()` - sters apelul si adaugat return type `: void`

### 4. Livewire 4 - Migrare rute Volt
**Fisier:** `routes/auth.php`
- `Volt::route()` inlocuit cu `Route::livewire()` pentru toate rutele de auth (register, login, forgot-password, reset-password, verify-email, confirm-password)
- Sters import `use Livewire\Volt\Volt;`

### 5. Livewire 4 - Sters VoltServiceProvider
- Sters `app/Providers/VoltServiceProvider.php`
- Scos din `bootstrap/providers.php`

### 6. Filament 5 - Tipuri proprietati
**Fisiere:** Toate Resources din `app/Filament/Resources/`
- `protected static ?string $navigationIcon` -> `protected static string | \BackedEnum | null $navigationIcon`
- `protected static ?string $navigationGroup` -> `protected static string | \UnitEnum | null $navigationGroup` (NewsletterResource, NewsletterSubscriberResource)
- Sters `protected static ?string $description` din NewsletterSubscriberResource (nu mai exista in Filament 5)

### 7. Filament 5 - Metoda form() Schema
**Fisiere:** AlbumResource, VideoResource, PostResource, NewsletterResource, UserResource, NewsletterSubscriberResource, HaineResource
- `use Filament\Forms\Form` -> `use Filament\Schemas\Schema`
- `public static function form(Form $form): Form` -> `public static function form(Schema $schema): Schema`
- `return $form` -> `return $schema`

### 8. Filament 5 - Widget $view non-static
**Fisier:** `app/Filament/Widgets/NotificareAbonatiWidget.php`
- `protected static string $view` -> `protected string $view`
- Sters `$navigationIcon` (nu se aplica pe widgets)

### 9. Livewire 4 - Migrare Volt Components din blade views
**Fisiere:** 10 blade files in `resources/views/livewire/`
- `use Livewire\Volt\Component` -> `use Livewire\Component` in toate componentele single-file:
  - `layout/navigation.blade.php`
  - `pages/auth/login.blade.php`
  - `pages/auth/register.blade.php`
  - `pages/auth/forgot-password.blade.php`
  - `pages/auth/reset-password.blade.php`
  - `pages/auth/verify-email.blade.php`
  - `pages/auth/confirm-password.blade.php`
  - `profile/update-profile-information-form.blade.php`
  - `profile/delete-user-form.blade.php`
  - `profile/update-password-form.blade.php`

### 10. Purifier migration
**Fisiere:** `app/Models/Reply.php`, `app/Models/Comment.php`
- `Mews\Purifier\Casts\CleanHtml` -> `Stevebauman\Purify\Casts\PurifyHtml`
- `Mews\Purifier\Facades\Purifier` -> `Stevebauman\Purify\Facades\Purify`
- Config: `config/purifier.php` sters si inlocuit cu `config/purify.php`

## De facut manual dupa upgrade

- [ ] `php artisan migrate` - Cashier 16 adauga coloane noi (`meter_event_name`, `meter_id`) in `subscription_items`
- [ ] `php artisan cache:clear` - curata cache-ul vechi
- [ ] Testeaza admin panel Filament (`/admin`)
- [ ] Testeaza login/register (Breeze + Google OAuth)
- [ ] Testeaza paginarea Livewire
- [ ] Testeaza Cashier/Stripe (checkout, abonamente)
- [ ] Instaleaza `laravel/boost`
- [ ] Verifica cupoanele Stripe - Cashier 16 nu mai suporta cupoane fara end date

## Referinte upgrade guides
- Laravel 13: https://laravel.com/docs/13.x/upgrade
- Livewire 4: https://livewire.laravel.com/docs/upgrading
- Filament 5: https://filamentphp.com/docs/5.x/upgrade-guide
- Cashier 16: https://github.com/laravel/cashier-stripe/blob/16.x/UPGRADE.md
