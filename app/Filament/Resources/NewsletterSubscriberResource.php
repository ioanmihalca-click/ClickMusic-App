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
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        Newsletter::STATUS_PENDING => 'success',
                        Newsletter::STATUS_FAILED => 'danger',
                        Newsletter::STATUS_SENT => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        Newsletter::STATUS_PENDING => 'Abonat',
                        Newsletter::STATUS_FAILED => 'Dezabonat',
                        Newsletter::STATUS_SENT => 'A primit emailuri',
                        default => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Data abonării')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Adaugă Abonat Newsletter'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Abonare')
                    ->options([
                        Newsletter::STATUS_PENDING => 'Abonat',
                        Newsletter::STATUS_FAILED => 'Dezabonat',
                        Newsletter::STATUS_SENT => 'A primit emailuri',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('toggle_subscription')
                    ->label(function ($record) {
                        return $record->status === Newsletter::STATUS_PENDING ? 'Dezabonează' : 'Reabonează';
                    })
                    ->icon(function ($record) {
                        return $record->status === Newsletter::STATUS_PENDING ? 'heroicon-o-no-symbol' : 'heroicon-o-check';
                    })
                    ->color(function ($record) {
                        return $record->status === Newsletter::STATUS_PENDING ? 'danger' : 'success';
                    })
                    ->action(function ($record) {
                        if ($record->status === Newsletter::STATUS_PENDING) {
                            $record->markAsFailed('Dezabonat manual');
                        } else {
                            $record->resetToPending();
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
        // Abordare simplificată: returnăm doar subscribers din newsletter table
        // și vom afișa utilizatorii separat prin filtre
        return parent::getEloquentQuery()
            ->where('campaign_type', Newsletter::TYPE_SUBSCRIBER)
            ->select([
                'id',
                'recipient_name',
                'recipient_email',
                'created_at',
                'status'
            ])
            ->selectRaw("'newsletter' as source")
            ->selectRaw("NULL as newsletter_unsubscribed_at")
            ->selectRaw("NULL as user_id")
            ->selectRaw("NULL as usertype");
    }

    /**
     * Ajustăm asignarea de model pentru tabelul combinat
     */
    public static function getModel(): string
    {
        return Newsletter::class;
    }
}
