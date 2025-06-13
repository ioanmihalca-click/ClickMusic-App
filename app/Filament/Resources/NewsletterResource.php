<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Newsletter;
use Filament\Tables\Table;
use App\Jobs\SendNewsletter;
use App\Jobs\SendNewsletters;
use Filament\Resources\Resource;
use Filament\Forms\Components\View;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard\Step;

use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification as FilamentNotification;
use App\Filament\Resources\NewsletterResource\Pages\EditNewsletter;
use App\Filament\Resources\NewsletterResource\Pages\ListNewsletters;
use App\Filament\Resources\NewsletterResource\Pages\CreateNewsletter;


class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Newsletter';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('recipient_name')
                    ->label('Nume Destinatar')
                    ->maxLength(255),
                TextInput::make('recipient_email')
                    ->label('Adresă Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        Newsletter::STATUS_PENDING => 'În așteptare',
                        Newsletter::STATUS_SENT => 'Trimis',
                        Newsletter::STATUS_FAILED => 'Eșuat',
                    ])
                    ->default(Newsletter::STATUS_PENDING)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('campaign_title')
                    ->label('Campanie/Email')
                    ->formatStateUsing(function ($record) {
                        if ($record->isCampaign()) {
                            return $record->campaign_title;
                        }
                        return $record->recipient_email;
                    })
                    ->searchable(['campaign_title', 'recipient_email'])
                    ->sortable(),

                TextColumn::make('campaign_type')
                    ->label('Tip')
                    ->badge()
                    ->formatStateUsing(fn($state) => $state === Newsletter::TYPE_CAMPAIGN ? 'Campanie' : 'Abonat')
                    ->colors([
                        'success' => Newsletter::TYPE_CAMPAIGN,
                        'info' => Newsletter::TYPE_SUBSCRIBER,
                    ])
                    ->sortable(),

                TextColumn::make('recipient_name')
                    ->label('Nume/Subiect')
                    ->formatStateUsing(function ($record) {
                        if ($record->isCampaign()) {
                            return $record->campaign_subject;
                        }
                        return $record->recipient_name;
                    })
                    ->searchable(['recipient_name', 'campaign_subject'])
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn($state) => Newsletter::make(['status' => $state])->status_label)
                    ->colors([
                        'warning' => Newsletter::STATUS_PENDING,
                        'success' => Newsletter::STATUS_SENT,
                        'danger' => Newsletter::STATUS_FAILED,
                    ])
                    ->sortable(),

                TextColumn::make('recipients_count')
                    ->label('Destinatari')
                    ->formatStateUsing(function ($record) {
                        if ($record->isCampaign()) {
                            return number_format($record->recipients_count);
                        }
                        return '1';
                    })
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('sent_count')
                    ->label('Trimiși')
                    ->formatStateUsing(function ($record) {
                        if ($record->isCampaign()) {
                            return $record->sent_count . '/' . $record->recipients_count;
                        }
                        return $record->status === Newsletter::STATUS_SENT ? '1/1' : '0/1';
                    })
                    ->alignCenter()
                    ->toggleable(),

                TextColumn::make('sent_at')
                    ->label('Trimis la')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('scheduled_at')
                    ->label('Programat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->visible(fn() => Newsletter::whereNotNull('scheduled_at')->exists()),

                TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('campaign_type')
                    ->label('Tip')
                    ->options([
                        Newsletter::TYPE_SUBSCRIBER => 'Abonați',
                        Newsletter::TYPE_CAMPAIGN => 'Campaniile',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        Newsletter::STATUS_PENDING => 'În așteptare',
                        Newsletter::STATUS_SENT => 'Trimis',
                        Newsletter::STATUS_FAILED => 'Eșuat',
                    ]),

                Filter::make('sent_today')
                    ->label('Trimise astăzi')
                    ->query(fn(Builder $query) => $query->sentToday()),

                Filter::make('campaigns_only')
                    ->label('Doar campaniile')
                    ->query(fn(Builder $query) => $query->campaigns()),

                Filter::make('search')
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->where('recipient_name', 'like', "%{$data['query']}%")
                            ->orWhere('recipient_email', 'like', "%{$data['query']}%")
                            ->orWhere('campaign_title', 'like', "%{$data['query']}%")
                            ->orWhere('campaign_subject', 'like', "%{$data['query']}%");
                    })
                    ->form([
                        TextInput::make('query')
                            ->label('Caută')
                            ->placeholder('Nume, email, titlu campanie...'),
                    ]),
            ])
            ->headerActions([
                // Info card cu statistici îmbunătățite
                Action::make('stats')
                    ->label('Statistici Newsletter')
                    ->icon('heroicon-o-chart-bar')
                    ->color('info')
                    ->modalContent(fn() => view('filament.newsletter-stats-combined'))
                    ->modalWidth('md')
                    ->slideOver(),

                // Editor pentru campanie newsletter
                Action::make('createCampaign')
                    ->label('Creează Campanie Newsletter')
                    ->icon('heroicon-o-pencil-square')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('title')
                            ->label('Titlu Campanie')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: Piesa nouă - Iunie 2025'),

                        Forms\Components\TextInput::make('subject')
                            ->label('Subiect Email')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: 🎵 Piesa noua de la Click!'),

                        Forms\Components\RichEditor::make('content')
                            ->label('Conținut Newsletter')
                            ->required()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'table',
                                'undo',
                            ])
                            ->placeholder('Scrie conținutul newsletter-ului aici...')
                            ->helperText('Poți folosi variabile: {{site_name}}, {{year}}, {{current_date}}, {{site_url}}'),

                        Forms\Components\Select::make('recipients')
                            ->label('Destinatari')
                            ->options([
                                'newsletter_only' => 'Doar Lista Newsletter (' . Newsletter::pending()->count() . ')',
                                'users_only' => 'Doar Utilizatori App (' . User::getNewsletterSubscribersCount() . ')',
                                'all' => 'TOȚI (Newsletter + Utilizatori) (' . self::getCombinedStats()['total_unique'] . ')',
                            ])
                            ->default('all')
                            ->required(),

                        Forms\Components\Toggle::make('send_now')
                            ->label('Trimite acum')
                            ->default(true)
                            ->helperText('Dezactivează pentru a salva ca draft'),

                        Forms\Components\DateTimePicker::make('scheduled_at')
                            ->label('Programează pentru')
                            ->visible(fn(Forms\Get $get) => !$get('send_now'))
                            ->minDate(now())
                            ->helperText('Campania se va trimite automat la data setată'),
                    ])
                    ->action(function (array $data): void {
                        // Creăm campania
                        $campaign = \App\Models\Newsletter::create([
                            'title' => $data['title'],
                            'subject' => $data['subject'],
                            'content' => $data['content'],
                            'status' => $data['send_now'] ? 'draft' : 'draft',
                            'scheduled_at' => $data['scheduled_at'] ?? null,
                            'created_by' => Auth::id(),
                        ]);

                        // Determinăm destinatarii
                        $recipients = match ($data['recipients']) {
                            'newsletter_only' => Newsletter::pending()->get(),
                            'users_only' => self::getUsersAsNewsletterFormat(),
                            'all' => self::getAllRecipientsAsNewsletterFormat(),
                        };

                        $campaign->update(['recipients_count' => $recipients->count()]);

                        if ($data['send_now']) {
                            // Trimitem imediat
                            self::sendCampaign($campaign, $recipients);

                            FilamentNotification::make()
                                ->title("Campania '{$campaign->title}' a fost lansată!")
                                ->body("Se trimit {$recipients->count()} emailuri...")
                                ->success()
                                ->send();
                        } else {
                            FilamentNotification::make()
                                ->title("Campania '{$campaign->title}' a fost salvată ca draft")
                                ->success()
                                ->send();
                        }
                    })
                    ->modalWidth('4xl'),

                Action::make('addEmail')
                    ->label('Adaugă Email')
                    ->icon('heroicon-o-plus')
                    ->form(fn(Form $form) => static::form($form))
                    ->action(function (array $data): void {
                        if (Newsletter::where('recipient_email', $data['recipient_email'])->exists()) {
                            FilamentNotification::make()
                                ->title('Email-ul există deja')
                                ->warning()
                                ->send();
                        } else {
                            Newsletter::create($data);
                            FilamentNotification::make()
                                ->title('Email adăugat cu succes')
                                ->success()
                                ->send();
                        }
                    }),

                // Quick send - pentru campaniile simple
                Action::make('quickSend')
                    ->label('Trimite Simplu')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->form([
                        Forms\Components\TextInput::make('quick_subject')
                            ->label('Subiect')
                            ->required()
                            ->default('🎵 Piesa noua de la Click!')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('quick_message')
                            ->label('Mesaj')
                            ->required()
                            ->rows(3)
                            ->placeholder('Salut! Am lansat o piesa noua...'),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label('Link YouTube')
                            ->url()
                            ->required()
                            ->placeholder('https://youtube.com/watch?v=...'),

                        Forms\Components\TextInput::make('image_url')
                            ->label('Imagine (URL)')
                            ->url()
                            ->required()
                            ->placeholder('https://example.com/image.jpg'),
                    ])
                    ->action(function (array $data): void {
                        // Generăm conținut HTML simplu
                        $content = self::generateSimpleEmailTemplate($data);

                        // Creăm și trimitem campania
                        $campaign = \App\Models\Newsletter::create([
                            'title' => 'Quick Send - ' . now()->format('d/m/Y H:i'),
                            'subject' => $data['quick_subject'],
                            'content' => $content,
                            'status' => 'draft',
                            'created_by' => Auth::id(),
                        ]);

                        $recipients = self::getAllRecipientsAsNewsletterFormat();
                        $campaign->update(['recipients_count' => $recipients->count()]);

                        self::sendCampaign($campaign, $recipients);

                        FilamentNotification::make()
                            ->title("Newsletter trimis!")
                            ->body("Se trimit {$recipients->count()} emailuri...")
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->visible(fn($record) => $record->isCampaign()),

                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => $record->canBeEdited()),

                Tables\Actions\DeleteAction::make(),

                // Preview pentru campaniile
                Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn($record) => $record->isCampaign())
                    ->modalContent(fn($record) => view('filament.campaign-preview', ['campaign' => $record]))
                    ->modalWidth('4xl'),

                // Trimite campania
                Action::make('sendCampaign')
                    ->label('Trimite')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->visible(fn($record) => $record->isCampaign() && $record->canBeSent())
                    ->action(function ($record): void {
                        $recipients = self::getAllRecipientsAsNewsletterFormat();
                        $record->update(['recipients_count' => $recipients->count()]);

                        self::sendCampaign($record, $recipients);

                        FilamentNotification::make()
                            ->title("Campania '{$record->campaign_title}' a fost lansată!")
                            ->body("Se trimit {$recipients->count()} emailuri...")
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),

                // Programează campania
                Action::make('schedule')
                    ->label('Programează')
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->visible(fn($record) => $record->isCampaign() && $record->canBeSent())
                    ->form([
                        Forms\Components\DateTimePicker::make('scheduled_at')
                            ->label('Programează pentru')
                            ->required()
                            ->minDate(now())
                            ->default(now()->addHour()),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->scheduleCampaign(new \DateTime($data['scheduled_at']));

                        FilamentNotification::make()
                            ->title("Campania programată!")
                            ->body("Se va trimite la {$data['scheduled_at']}")
                            ->success()
                            ->send();
                    }),

                // Resetează status pentru abonați
                Action::make('reset')
                    ->label('Resetează')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->action(function (Newsletter $record): void {
                        $record->resetToPending();
                        FilamentNotification::make()
                            ->title('Status resetat la "În așteptare"')
                            ->success()
                            ->send();
                    })
                    ->visible(fn(Newsletter $record) => $record->isSubscriber() && $record->status !== Newsletter::STATUS_PENDING)
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                self::getSendNewsletterBulkAction('sendSelected', 'Trimite selectate', fn($records) => $records),

                // Bulk action pentru a trimite la utilizatori + selectate
                self::getSendNewsletterBulkAction(
                    'sendSelectedPlusUsers',
                    'Trimite la Selectate + Utilizatori App',
                    fn($records) => $records->merge(self::getUsersAsNewsletterFormat())
                ),

                // Bulk action pentru resetare
                Tables\Actions\BulkAction::make('resetStatus')
                    ->label('Resetează status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->action(function (Collection $records): void {
                        $records->each(fn($record) => $record->resetToPending());
                        FilamentNotification::make()
                            ->title('Statusul a fost resetat pentru ' . $records->count() . ' newslettere')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    private static function getSendNewsletterAction(string $name, string $label, callable $getRecords): Action
    {
        return Action::make($name)
            ->label($label)
            ->icon('heroicon-o-paper-airplane')
            ->form(self::getSendNewsletterForm())
            ->action(function ($record, array $data) use ($getRecords): void {
                try {
                    $newsletters = $getRecords($record);

                    // Verificăm dacă avem newslettere de trimis
                    if ($newsletters->isEmpty()) {
                        FilamentNotification::make()
                            ->title("Nu există newslettere de trimis")
                            ->warning()
                            ->send();
                        return;
                    }

                    // Verificăm limita zilnică
                    $remainingQuota = Newsletter::getRemainingQuota();
                    if ($remainingQuota <= 0) {
                        FilamentNotification::make()
                            ->title("Limita zilnică a fost atinsă")
                            ->body("Au fost deja trimise 200 de emailuri astăzi. Încearcă mâine.")
                            ->warning()
                            ->send();
                        return;
                    }

                    SendNewsletters::dispatch(
                        $newsletters,
                        $data['image_url'],
                        $data['url']
                    );

                    $message = $newsletters->count() > $remainingQuota
                        ? "Job inițiat pentru {$newsletters->count()} newslettere. Astăzi se vor trimite {$remainingQuota}, restul mâine."
                        : "Job pentru trimiterea a {$newsletters->count()} newslettere a fost inițiat";

                    FilamentNotification::make()
                        ->title($message)
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Log::error("Eroare la trimiterea newsletterului: " . $e->getMessage());
                    FilamentNotification::make()
                        ->title("Eroare la trimiterea newsletterului")
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->requiresConfirmation()
            ->modalWidth('2xl');
    }

    private static function getSendNewsletterForm(): array
    {
        return [
            Forms\Components\TextInput::make('image_url')
                ->label('URL Imagine')
                ->url()
                ->required()
                ->placeholder('https://example.com/image.jpg'),
            Forms\Components\TextInput::make('url')
                ->label('URL Destinație')
                ->url()
                ->required()
                ->placeholder('https://youtube.com/watch?v=...'),
        ];
    }

    private static function getSendNewsletterBulkAction(string $name, string $label, callable $getRecords): Tables\Actions\BulkAction
    {
        return Tables\Actions\BulkAction::make($name)
            ->label($label)
            ->icon('heroicon-o-paper-airplane')
            ->form(self::getSendNewsletterForm())
            ->action(function (Collection $records, array $data) use ($getRecords): void {
                try {
                    $newsletters = $getRecords($records);

                    if ($newsletters->isEmpty()) {
                        FilamentNotification::make()
                            ->title("Nu există newslettere de trimis")
                            ->warning()
                            ->send();
                        return;
                    }

                    $remainingQuota = Newsletter::getRemainingQuota();
                    if ($remainingQuota <= 0) {
                        FilamentNotification::make()
                            ->title("Limita zilnică a fost atinsă")
                            ->body("Au fost deja trimise 200 de emailuri astăzi. Încearcă mâine.")
                            ->warning()
                            ->send();
                        return;
                    }

                    SendNewsletters::dispatch(
                        $newsletters,
                        $data['image_url'],
                        $data['url']
                    );

                    $message = $newsletters->count() > $remainingQuota
                        ? "Job inițiat pentru {$newsletters->count()} newslettere. Astăzi se vor trimite {$remainingQuota}, restul mâine."
                        : "Job pentru trimiterea a {$newsletters->count()} newslettere a fost inițiat";

                    FilamentNotification::make()
                        ->title($message)
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Log::error("Eroare la trimiterea newsletterului: " . $e->getMessage());
                    FilamentNotification::make()
                        ->title("Eroare la trimiterea newsletterului")
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->requiresConfirmation();
    }

    /**
     * Trimite o campanie de newsletter
     */
    private static function sendCampaign(Newsletter $campaign, Collection $recipients): void
    {
        try {
            // Verificăm limita zilnică
            $remainingQuota = Newsletter::getRemainingQuota();
            if ($remainingQuota <= 0) {
                FilamentNotification::make()
                    ->title("Limita zilnică atinsă")
                    ->body("Campania va fi trimisă mâine dimineață.")
                    ->warning()
                    ->send();
            }

            // Lansăm job-ul pentru trimitere folosind noul job
            SendNewsletters::dispatch($campaign, $recipients);

            // Nu mai marcăm ca sending, job-ul se va ocupa de asta

        } catch (\Exception $e) {
            Log::error("Eroare la lansarea campaniei {$campaign->id}: " . $e->getMessage());
            $campaign->markAsFailed();

            FilamentNotification::make()
                ->title("Eroare la trimiterea campaniei")
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Helper methods pentru combinarea utilizatorilor cu newsletterele
     */

    /**
     * Convertește utilizatorii în format compatibil cu Newsletter
     */
    private static function getUsersAsNewsletterFormat(): Collection
    {
        return User::getNewsletterSubscribers()->map(function ($user) {
            // Creăm un obiect pseudo-Newsletter pentru compatibilitate
            $pseudoNewsletter = new class($user) {
                public $id;
                public $recipient_email;
                public $recipient_name;
                public $status = 'pending';
                public $user;

                public function __construct($user)
                {
                    $this->user = $user;
                }

                public function notify($notification)
                {
                    // Delegăm notificarea către userul real
                    return $this->user->notify($notification);
                }

                public function markAsSent()
                {
                    // Pentru utilizatori, nu marcăm nimic special
                    return true;
                }

                public function markAsFailed($errorMessage = null)
                {
                    // Pentru utilizatori, loghează eroarea dar nu marchează
                    \Illuminate\Support\Facades\Log::error("Newsletter failed for user {$this->recipient_email}: {$errorMessage}");
                    return true;
                }
            };

            $pseudoNewsletter->id = 'user_' . $user->id;
            $pseudoNewsletter->recipient_email = $user->email;
            $pseudoNewsletter->recipient_name = $user->name;

            return $pseudoNewsletter;
        });
    }

    /**
     * Combină newsletterele pending cu utilizatorii abonați
     */
    private static function getAllRecipientsAsNewsletterFormat(): Collection
    {
        $newsletters = Newsletter::pending()->get();
        $users = self::getUsersAsNewsletterFormat();

        // Evităm duplicatele - verificăm dacă email-ul există deja în newsletters
        $newsletterEmails = $newsletters->pluck('recipient_email')->toArray();
        $uniqueUsers = $users->filter(function ($user) use ($newsletterEmails) {
            return !in_array($user->recipient_email, $newsletterEmails);
        });

        return $newsletters->merge($uniqueUsers);
    }

    /**
     * Statistici combinate pentru newsletter + utilizatori
     */
    public static function getCombinedStats(): array
    {
        $newsletterCount = Newsletter::pending()->count();
        $usersCount = User::getNewsletterSubscribersCount();

        // Verificăm duplicatele
        $newsletterEmails = Newsletter::pending()->pluck('recipient_email')->toArray();
        $duplicateUsersCount = User::newsletterSubscribed()
            ->whereIn('email', $newsletterEmails)
            ->count();

        return [
            'newsletter_pending' => $newsletterCount,
            'users_subscribed' => $usersCount,
            'duplicates' => $duplicateUsersCount,
            'total_unique' => $newsletterCount + $usersCount - $duplicateUsersCount,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNewsletters::route('/'),
            'edit' => EditNewsletter::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
