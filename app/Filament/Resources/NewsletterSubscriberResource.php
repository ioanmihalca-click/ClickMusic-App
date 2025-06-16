<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\User;
use Filament\Forms\Form;
use App\Models\Newsletter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Filament\Resources\NewsletterSubscriberResource\Pages\CreateNewsletterSubscriber;
use App\Filament\Resources\NewsletterSubscriberResource\Pages\EditNewsletterSubscriber;
use App\Filament\Resources\NewsletterSubscriberResource\Pages\ListNewsletterSubscribers;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = Newsletter::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Abonați Newsletter';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?int $navigationSort = 8;
    protected static ?string $modelLabel = 'Abonat Newsletter';
    protected static ?string $pluralModelLabel = 'Abonați Newsletter';
    protected static ?string $recordTitleAttribute = 'recipient_email';
    protected static ?string $slug = 'newsletter-subscribers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('recipient_name')
                    ->label('Nume')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('recipient_email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_user')
                    ->label('Este utilizator înregistrat?')
                    ->default(false)
                    ->disabled()
                    ->dehydrated(false),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Data abonării')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('recipient_name')
                    ->label('Nume')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('recipient_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('source')
                    ->label('Sursa')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'user' => 'success',
                        'newsletter' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'user' => 'Cont utilizator',
                        'newsletter' => 'Formular newsletter',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Data abonării')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                TextColumn::make('subscription_status')
                    ->label('Status abonare')
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        $isUser = $record->source === 'user';
                        $isSubscribed = $isUser ?
                            is_null($record->newsletter_unsubscribed_at) : ($record->status === Newsletter::STATUS_PENDING);

                        return $isSubscribed ? 'Abonat' : 'Dezabonat';
                    })
                    ->color(function ($record) {
                        $isUser = $record->source === 'user';
                        $isSubscribed = $isUser ?
                            is_null($record->newsletter_unsubscribed_at) : ($record->status === Newsletter::STATUS_PENDING);

                        return $isSubscribed ? 'success' : 'danger';
                    }),
                TextColumn::make('user.usertype')
                    ->label('Tip cont')
                    ->visible(function ($livewire) {
                        // Verificăm mai întâi dacă filtrul există și are valoare
                        if (!isset($livewire->tableFilters['source']) || !isset($livewire->tableFilters['source']['value'])) {
                            return false;
                        }
                        return $livewire->tableFilters['source']['value'] === 'user';
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'danger',
                        'super_user' => 'warning',
                        'subscriber' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('source')
                    ->label('Sursa')
                    ->options([
                        'user' => 'Conturi utilizatori',
                        'newsletter' => 'Formular newsletter',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Toți abonații')
                    ->trueLabel('Activi')
                    ->falseLabel('Dezabonați')
                    ->queries(
                        true: fn(Builder $query) => $query->where(function ($query) {
                            return $query->where(function ($subQuery) {
                                $subQuery->where('source', 'user')
                                    ->whereNull('newsletter_unsubscribed_at');
                            })->orWhere(function ($subQuery) {
                                $subQuery->where('source', 'newsletter')
                                    ->where('status', Newsletter::STATUS_PENDING);
                            });
                        }),
                        false: fn(Builder $query) => $query->where(function ($query) {
                            return $query->where(function ($subQuery) {
                                $subQuery->where('source', 'user')
                                    ->whereNotNull('newsletter_unsubscribed_at');
                            })->orWhere(function ($subQuery) {
                                $subQuery->where('source', 'newsletter')
                                    ->whereNotIn('status', [Newsletter::STATUS_PENDING]);
                            });
                        }),
                        blank: fn(Builder $query) => $query,
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function ($record) {
                        // Verificăm dacă este un utilizator și, dacă da, îl dezabonăm în loc să-l ștergem
                        if ($record->source === 'user') {
                            $user = User::where('email', $record->recipient_email)->first();
                            if ($user) {
                                $user->unsubscribeFromNewsletter();
                            }
                            return false; // Nu ștergem record-ul, doar am dezabonat utilizatorul
                        }
                        // Pentru abonat simplu, lăsăm să continue acțiunea de ștergere
                    }),
                Tables\Actions\Action::make('toggle_subscription')
                    ->label(function ($record) {
                        $isUser = $record->source === 'user';
                        $isUnsubscribed = $isUser ?
                            !is_null($record->newsletter_unsubscribed_at) : ($record->status !== Newsletter::STATUS_PENDING);

                        return $isUnsubscribed ? 'Reabonează' : 'Dezabonează';
                    })
                    ->icon(function ($record) {
                        $isUser = $record->source === 'user';
                        $isUnsubscribed = $isUser ?
                            !is_null($record->newsletter_unsubscribed_at) : ($record->status !== Newsletter::STATUS_PENDING);

                        return $isUnsubscribed ? 'heroicon-o-check' : 'heroicon-o-no-symbol';
                    })
                    ->color(function ($record) {
                        $isUser = $record->source === 'user';
                        $isUnsubscribed = $isUser ?
                            !is_null($record->newsletter_unsubscribed_at) : ($record->status !== Newsletter::STATUS_PENDING);

                        return $isUnsubscribed ? 'success' : 'danger';
                    })->action(function ($record) {
                        if ($record->source === 'user') {
                            $user = User::where('email', $record->recipient_email)->first();
                            if ($user) {
                                // Verificăm direct starea newsletter_unsubscribed_at
                                if (!is_null($record->newsletter_unsubscribed_at)) {
                                    // Dacă este dezabonat, îl reabonăm
                                    $user->subscribeToNewsletter();
                                } else {
                                    // Dacă este abonat, îl dezabonăm
                                    $user->unsubscribeFromNewsletter();
                                }
                            }
                        } else {
                            if ($record->status === Newsletter::STATUS_PENDING) {
                                // Dacă este în așteptare, îl marcăm ca failed (dezabonat)
                                $record->markAsFailed('Dezabonat manual');
                            } else {
                                // Dacă este deja failed/dezabonat, îl resetăm la pending (reabonare)
                                $record->resetToPending();
                            }
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSubscribers::route('/'),
            'create' => Pages\CreateNewsletterSubscriber::route('/create'),
            'edit' => Pages\EditNewsletterSubscriber::route('/{record}/edit'),
        ];
    }

    /**
     * Aplicăm modificări pentru a putea afișa în tabel atât utilizatorii abonați cât și adresele directe din newsletter
     */
    public static function getEloquentQuery(): Builder
    {
        // Pornim de la query-ul standard
        $newsletterQuery = parent::getEloquentQuery()
            ->subscribers() // Luăm doar subscriberii, nu campaniile
            ->select([
                'id',
                'recipient_name',
                'recipient_email',
                'created_at',
                'status',
            ])
            ->selectRaw("'newsletter' as source")
            ->selectRaw("NULL as newsletter_unsubscribed_at")
            ->selectRaw("NULL as user_id")
            ->selectRaw("NULL as usertype");        // Obținem toți utilizatorii (abonați și dezabonați) cu date convertite în formatul așteptat
        $userQuery = User::select([
            'id as user_id',
            'name as recipient_name',
            'email as recipient_email',
            'created_at',
            'newsletter_unsubscribed_at',
            'usertype',
        ])
            ->selectRaw("NULL as id")
            ->selectRaw("'user' as source")
            ->selectRaw("CASE WHEN newsletter_unsubscribed_at IS NULL THEN 'pending' ELSE 'failed' END as status");

        // Unim cele două query-uri
        return $newsletterQuery->union($userQuery);
    }

    /**
     * Ajustăm asignarea de model pentru tabelul combinat
     */
    public static function getModel(): string
    {
        return Newsletter::class;
    }
}
