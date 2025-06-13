<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Newsletter;
use Filament\Tables\Table;
use App\Jobs\SendNewsletters;
use Filament\Resources\Resource;
use Filament\Forms\Components\View;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\BadgeColumn;
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
                TextColumn::make('recipient_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('recipient_name')
                    ->label('Nume')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn($state) => Newsletter::make(['status' => $state])->status_label)
                    ->colors([
                        'warning' => Newsletter::STATUS_PENDING,
                        'success' => Newsletter::STATUS_SENT,
                        'danger' => Newsletter::STATUS_FAILED,
                    ])
                    ->sortable(),
                TextColumn::make('sent_at')
                    ->label('Trimis la')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('failed_at')
                    ->label('Eșuat la')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->visible(fn() => Newsletter::failed()->exists()),
                TextColumn::make('error_message')
                    ->label('Mesaj eroare')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    })
                    ->toggleable()
                    ->visible(fn() => Newsletter::failed()->exists()),
                TextColumn::make('created_at')
                    ->label('Creat la')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
                Filter::make('failed')
                    ->label('Eșuate')
                    ->query(fn(Builder $query) => $query->failed()),
                Filter::make('search')
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->where('recipient_name', 'like', "%{$data['query']}%")
                            ->orWhere('recipient_email', 'like', "%{$data['query']}%");
                    })
                    ->form([
                        TextInput::make('query')
                            ->label('Caută după nume sau email')
                            ->placeholder('Introdu textul de căutare'),
                    ]),
            ])
            ->headerActions([
                // Info card cu statistici
                Action::make('stats')
                    ->label('Statistici Newsletter')
                    ->icon('heroicon-o-chart-bar')
                    ->color('info')
                    ->modalContent(fn() => view('filament.newsletter-stats'))
                    ->modalWidth('md')
                    ->slideOver(),

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
                self::getSendNewsletterAction('sendAll', 'Trimite tuturor', fn() => Newsletter::pending()->get())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                self::getSendNewsletterAction('send', 'Trimite individual', fn($record) => collect([$record])),

                // Acțiune pentru a reseta statusul la pending
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
                    ->visible(fn(Newsletter $record) => $record->status !== Newsletter::STATUS_PENDING)
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                self::getSendNewsletterBulkAction('sendSelected', 'Trimite selectate', fn($records) => $records),

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
