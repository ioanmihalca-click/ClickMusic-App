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
    protected static ?string $navigationLabel = 'Campanii Newsletter';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Pentru abonați simpli
                Forms\Components\Section::make('Abonat Newsletter')
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
                    ])
                    ->visible(fn(?Newsletter $record) => $record?->isSubscriber() ?? true)
                    ->columnSpanFull(),

                // Pentru campaniile newsletter
                Forms\Components\Section::make('Detalii Campanie')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('campaign_title')
                                    ->label('Titlu Campanie')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex: Piesa nouă - Iunie 2025'),

                                TextInput::make('campaign_subject')
                                    ->label('Subiect Email')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ex: 🎵 Piesa noua de la Click!'),
                            ]),

                        Forms\Components\RichEditor::make('campaign_content')
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
                            ->helperText('Poți folosi variabile: {{site_name}}, {{year}}, {{current_date}}, {{site_url}}, {{email}}, {{name}}')
                            ->columnSpanFull(),
                    ])
                    ->visible(fn(?Newsletter $record) => $record?->isCampaign() ?? false)
                    ->columnSpanFull(),

                // Secțiune programare și statistici
                Forms\Components\Section::make('Programare și Statistici')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DateTimePicker::make('scheduled_at')
                                    ->label('Programat pentru')
                                    ->helperText('Lasă gol pentru trimitere imediată')
                                    ->minDate(now()),

                                Forms\Components\Select::make('status')
                                    ->label('Status Campanie')
                                    ->options([
                                        Newsletter::STATUS_PENDING => 'Draft/În așteptare',
                                        Newsletter::STATUS_SENT => 'Trimis',
                                        Newsletter::STATUS_FAILED => 'Eșuat',
                                    ])
                                    ->required(),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('recipients_count')
                                    ->label('Total Destinatari')
                                    ->numeric()
                                    ->disabled()
                                    ->helperText('Se actualizează automat'),

                                Forms\Components\TextInput::make('sent_count')
                                    ->label('Trimiși cu Succes')
                                    ->numeric()
                                    ->disabled()
                                    ->helperText('Actualizat după trimitere'),

                                Forms\Components\TextInput::make('failed_count')
                                    ->label('Eșuați')
                                    ->numeric()
                                    ->disabled()
                                    ->helperText('Erori de trimitere'),
                            ]),
                    ])
                    ->visible(fn(?Newsletter $record) => $record?->isCampaign() ?? false)
                    ->columnSpanFull(),

                // Template-uri predefinite (bonus)
                Forms\Components\Section::make('Template-uri Rapide')
                    ->schema([
                        Forms\Components\Select::make('template')
                            ->label('Alege un template')
                            ->options([
                                'song_announcement' => '🎵 Anunț Piesă Nouă',
                                'video_release' => '📹 Lansare Video',
                                'event_announcement' => '🎤 Anunț Eveniment',
                                'monthly_update' => '📰 Update Lunar',
                                'custom' => '✏️ Custom (fără template)',
                            ])
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                $templates = self::getEmailTemplates();
                                if (isset($templates[$state])) {
                                    $template = $templates[$state];
                                    $set('campaign_subject', $template['subject']);
                                    $set('campaign_content', $template['content']);
                                }
                            })
                            ->helperText('Selectează un template pentru a începe rapid'),
                    ])
                    ->visible(fn(?Newsletter $record) => $record === null || ($record->isCampaign() && $record->canBeEdited()))
                    ->columnSpanFull()
                    ->collapsible(),
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
                    ->formatStateUsing(fn($state) => Newsletter::make(['status' => $state])->status_label)
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        Newsletter::STATUS_PENDING => 'warning',
                        Newsletter::STATUS_SENT => 'success',
                        Newsletter::STATUS_FAILED => 'danger',
                        default => 'gray',
                    })
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
                    ->modalContent(fn() => view('filament.newsletter-stats'))
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
                        // Determinăm destinatarii
                        $recipients = match ($data['recipients']) {
                            'newsletter_only' => Newsletter::pending()->get(),
                            'users_only' => self::getUsersAsNewsletterFormat(),
                            'all' => self::getAllRecipientsAsNewsletterFormat(),
                        };

                        // Creăm campania folosind metoda createCampaign din model
                        $campaign = Newsletter::createCampaign([
                            'title' => $data['title'],
                            'subject' => $data['subject'],
                            'content' => $data['content'],
                            'recipients_count' => $recipients->count(),
                            'scheduled_at' => $data['scheduled_at'] ?? null,
                            'created_by' => Auth::id(),
                        ]);
                        if ($data['send_now']) {
                            // Trimitem imediat
                            self::sendCampaign($campaign, $recipients);

                            FilamentNotification::make()
                                ->title("Campania '{$campaign->campaign_title}' a fost lansată!")
                                ->body("Se trimit {$recipients->count()} emailuri...")
                                ->success()
                                ->send();
                        } else {
                            FilamentNotification::make()
                                ->title("Campania '{$campaign->campaign_title}' a fost salvată ca draft")
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

                        // Creăm și trimitem campania folosind metoda createCampaign
                        $recipients = self::getAllRecipientsAsNewsletterFormat();

                        $campaign = Newsletter::createCampaign([
                            'title' => 'Quick Send - ' . now()->format('d/m/Y H:i'),
                            'subject' => $data['quick_subject'],
                            'content' => $content,
                            'recipients_count' => $recipients->count(),
                            'created_by' => Auth::id(),
                        ]);

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

    /**
     * Modificăm query-ul ca să arate doar campaniile, nu și abonații din formular
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('campaign_type', Newsletter::TYPE_CAMPAIGN);
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

                    // Verificăm limita zilnică prin sistemul unificat
                    $remainingQuota = \App\Models\DailyEmailTracker::getRemainingQuota();
                    if ($remainingQuota <= 0) {
                        $dailyLimit = config('mail.daily_limit', 100);
                        FilamentNotification::make()
                            ->title("Limita zilnică a fost atinsă")
                            ->body("Au fost deja trimise {$dailyLimit} de emailuri astăzi. Încearcă mâine.")
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

                    $remainingQuota = \App\Models\DailyEmailTracker::getRemainingQuota();
                    if ($remainingQuota <= 0) {
                        $dailyLimit = config('mail.daily_limit', 100);
                        FilamentNotification::make()
                            ->title("Limita zilnică a fost atinsă")
                            ->body("Au fost deja trimise {$dailyLimit} de emailuri astăzi. Încearcă mâine.")
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
     * Template-uri predefinite pentru newslettere
     */
    private static function getEmailTemplates(): array
    {
        return [
            'song_announcement' => [
                'subject' => '🎵 Piesa nouă de la Click!',
                'content' => '
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; text-align: center;">
        <h1 style="color: white; margin: 0;">{{site_name}}</h1>
        <p style="color: white; margin: 10px 0 0 0; opacity: 0.9;">Muzică de calitate pentru sufletul tău</p>
    </div>
    
    <div style="padding: 30px 20px; background: white;">
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Salut {{name}}!
        </p>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Sper că acest email te găsește bine. Vreau să te anunț că am lansat o nouă piesă!
        </p>
        
        <div style="text-align: center; margin: 30px 0;">
            <img src="[ADAUGĂ_URL_IMAGINE]" alt="Piesa nouă" style="max-width: 100%; height: auto; border-radius: 8px;" />
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="[ADAUGĂ_URL_YOUTUBE]" style="display: inline-block; background: #ff0000; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">
                ▶️ Ascultă pe YouTube
            </a>
        </div>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Aștept cu drag să mă saluți și să-mi spui părerea ta despre piesă într-un comentariu. Să ne auzim cu bine!
        </p>
    </div>
    
    <div style="background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666;">
        <p style="margin: 0 0 10px 0;">
            Cu respect,<br>
            <strong>Click</strong>
        </p>
        
        <p style="margin: 10px 0;">
            <a href="https://www.youtube.com/clickmusicromania" style="color: #dc2626; text-decoration: none; margin: 0 10px;">YouTube</a>
            <a href="{{site_url}}" style="color: #3b82f6; text-decoration: none; margin: 0 10px;">{{site_name}}</a>
        </p>
        
        <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;">
            Dacă nu mai dorești să primești newslettere, te poți 
            <a href="{{site_url}}/newsletter/unsubscribe?email={{email}}" style="color: #3869d4;">dezabona aici</a>.
        </p>
    </div>
</div>'
            ],

            'video_release' => [
                'subject' => '📹 Video nou de la Click Music!',
                'content' => '
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
    <div style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); padding: 20px; text-align: center;">
        <h1 style="color: white; margin: 0;">{{site_name}}</h1>
        <p style="color: white; margin: 10px 0 0 0; opacity: 0.9;">📹 Video nou disponibil!</p>
    </div>
    
    <div style="padding: 30px 20px; background: white;">
        <h2 style="color: #333; text-align: center; margin-bottom: 20px;">Am lansat un video nou!</h2>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Salut {{name}}!
        </p>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            [ADAUGĂ_DESCRIEREA_VIDEO]
        </p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="[ADAUGĂ_URL_VIDEO]">
                <img src="[ADAUGĂ_THUMBNAIL_VIDEO]" alt="Video nou" style="max-width: 100%; height: auto; border-radius: 8px; border: 3px solid #ff6b6b;" />
            </a>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="[ADAUGĂ_URL_VIDEO]" style="display: inline-block; background: #ff6b6b; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">
                🎬 Vezi Videoul
            </a>
        </div>
    </div>
    
    <div style="background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666;">
        <p style="margin: 0 0 10px 0;">Cu respect,<br><strong>Click</strong></p>
        <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;">
            <a href="{{site_url}}/newsletter/unsubscribe?email={{email}}" style="color: #3869d4;">Dezabonează-te</a>
        </p>
    </div>
</div>'
            ],

            'event_announcement' => [
                'subject' => '🎤 Eveniment special cu Click Music!',
                'content' => '
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
    <div style="background: linear-gradient(135deg, #00b894 0%, #00a085 100%); padding: 20px; text-align: center;">
        <h1 style="color: white; margin: 0;">{{site_name}}</h1>
        <p style="color: white; margin: 10px 0 0 0; opacity: 0.9;">🎤 Eveniment special!</p>
    </div>
    
    <div style="padding: 30px 20px; background: white;">
        <h2 style="color: #333; text-align: center; margin-bottom: 20px;">Te invit la un eveniment special!</h2>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Salut {{name}}!
        </p>
        
        <div style="background: #f0f9ff; border-left: 4px solid #00b894; padding: 20px; margin: 20px 0;">
            <h3 style="margin: 0 0 10px 0; color: #00b894;">[NUME_EVENIMENT]</h3>
            <p style="margin: 5px 0; color: #333;"><strong>📅 Data:</strong> [DATA_EVENIMENT]</p>
            <p style="margin: 5px 0; color: #333;"><strong>📍 Locația:</strong> [LOCAȚIA_EVENIMENT]</p>
            <p style="margin: 5px 0; color: #333;"><strong>🕐 Ora:</strong> [ORA_EVENIMENT]</p>
        </div>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            [DESCRIEREA_EVENIMENTULUI]
        </p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="[LINK_BILETE]" style="display: inline-block; background: #00b894; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">
                🎟️ Rezervă Bilete
            </a>
        </div>
    </div>
    
    <div style="background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666;">
        <p style="margin: 0 0 10px 0;">Cu respect,<br><strong>Click</strong></p>
        <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;">
            <a href="{{site_url}}/newsletter/unsubscribe?email={{email}}" style="color: #3869d4;">Dezabonează-te</a>
        </p>
    </div>
</div>'
            ],

            'monthly_update' => [
                'subject' => '📰 Update lunar de la Click Music',
                'content' => '
<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
    <div style="background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%); padding: 20px; text-align: center;">
        <h1 style="color: white; margin: 0;">{{site_name}}</h1>
        <p style="color: white; margin: 10px 0 0 0; opacity: 0.9;">📰 Update lunar - {{current_date}}</p>
    </div>
    
    <div style="padding: 30px 20px; background: white;">
        <h2 style="color: #333; margin-bottom: 20px;">Ce mai fac în ultima vreme?</h2>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Salut {{name}}!
        </p>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Iată ce s-a întâmplat în ultima lună la Click Music:
        </p>
        
        <div style="background: #f8f9ff; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="color: #6c5ce7; margin: 0 0 15px 0;">🎵 Muzică</h3>
            <ul style="color: #333; margin: 0; padding-left: 20px;">
                <li>[ADAUGĂ_UPDATE_MUZICAL]</li>
                <li>[ADAUGĂ_UPDATE_MUZICAL]</li>
            </ul>
        </div>
        
        <div style="background: #fff5f5; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="color: #e17055; margin: 0 0 15px 0;">📹 Video</h3>
            <ul style="color: #333; margin: 0; padding-left: 20px;">
                <li>[ADAUGĂ_UPDATE_VIDEO]</li>
                <li>[ADAUGĂ_UPDATE_VIDEO]</li>
            </ul>
        </div>
        
        <div style="background: #f0fff4; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="color: #00b894; margin: 0 0 15px 0;">🎤 Evenimente</h3>
            <ul style="color: #333; margin: 0; padding-left: 20px;">
                <li>[ADAUGĂ_UPDATE_EVENIMENT]</li>
            </ul>
        </div>
        
        <p style="font-size: 16px; line-height: 1.6; color: #333;">
            Mulțumesc că îmi urmărești activitatea! 🙏
        </p>
    </div>
    
    <div style="background: #f8f9fa; padding: 20px; text-align: center; font-size: 14px; color: #666;">
        <p style="margin: 0 0 10px 0;">Cu respect,<br><strong>Click</strong></p>
        <p style="margin: 15px 0 0 0; font-size: 12px; color: #999;">
            <a href="{{site_url}}/newsletter/unsubscribe?email={{email}}" style="color: #3869d4;">Dezabonează-te</a>
        </p>
    </div>
</div>'
            ],
        ];
    }

    /**
     * Trimite o campanie de newsletter
     */
    private static function sendCampaign(Newsletter $campaign, Collection $recipients): void
    {
        try {
            // Verificăm limita zilnică prin sistemul unificat
            $remainingQuota = \App\Models\DailyEmailTracker::getRemainingQuota();
            if ($remainingQuota <= 0) {
                FilamentNotification::make()
                    ->title("Limita zilnică atinsă")
                    ->body("Campania va fi trimisă mâine dimineață la 08:00.")
                    ->warning()
                    ->send();
            }

            // Convertim toți recipients într-un format uniform pentru queue
            $recipientsData = $recipients->map(function ($recipient) {
                return [
                    'email' => $recipient->recipient_email,
                    'name' => $recipient->recipient_name,
                    'type' => isset($recipient->user) ? 'user' : 'newsletter',
                    'user_id' => isset($recipient->user) ? $recipient->user->id : null,
                    'newsletter_id' => is_numeric($recipient->id) ? $recipient->id : null,
                ];
            });

            // Lansăm job-ul cu date serializabile
            SendNewsletters::dispatch($campaign->id, $recipientsData);
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
        $mappedCollection = User::getNewsletterSubscribers()->map(function ($user) {
            // Creăm un obiect pseudo-Newsletter pentru compatibilitate
            $pseudoNewsletter = new class {
                public $id;
                public $recipient_email;
                public $recipient_name;
                public $status = 'pending';
                public $user;

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

                public function getKey()
                {
                    // Returnează id-ul ca și key pentru compatibilitate cu modelele Eloquent
                    return $this->id;
                }
            };

            $pseudoNewsletter->id = 'user_' . $user->id;
            $pseudoNewsletter->recipient_email = $user->email;
            $pseudoNewsletter->recipient_name = $user->name;
            $pseudoNewsletter->user = $user; // Referință către userul real

            return $pseudoNewsletter;
        });

        // Convertim Illuminate\Support\Collection la Illuminate\Database\Eloquent\Collection
        return new \Illuminate\Database\Eloquent\Collection($mappedCollection->all());
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
            'create' => CreateNewsletter::route('/create'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
