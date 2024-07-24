<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\PromoEmail;
use Filament\Tables\Table;
use App\Jobs\SendPromoEmails;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification as FilamentNotification;
use App\Filament\Resources\PromoEmailResource\Pages\EditPromoEmail;
use App\Filament\Resources\PromoEmailResource\Pages\ListPromoEmails;

class PromoEmailResource extends Resource
{
    protected static ?string $model = PromoEmail::class;
    protected static ?string $navigationIcon = 'heroicon-o-radio';
    protected static ?string $navigationLabel = 'Comunicat de presa Radio/DJ';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('recipient_name')
                    ->label('Nume Destinatar')
                    ->required()
                    ->maxLength(255),
                TextInput::make('recipient_email')
                    ->label('Adresă Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Alte câmpuri necesare
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('recipient_email'),
                TextColumn::make('recipient_name'),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => self::getStatusLabel($state))
                    ->color(fn (string $state): string => self::getStatusColor($state)),
            ])
            ->filters([
                  // Căutare după nume sau email
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
                Action::make('addEmail')
                    ->label('Adaugă Email')
                    ->icon('heroicon-o-plus')
                    ->form(fn (Form $form) => static::form($form))
                    ->action(function (array $data): void {
                        // Verificare dacă email-ul există deja
                        if (PromoEmail::where('recipient_email', $data['recipient_email'])->exists()) {
                            FilamentNotification::make()
                                ->title('Email-ul există deja')
                                ->warning()
                                ->send();
                        } else {
                            PromoEmail::create($data);
                            FilamentNotification::make()
                                ->title('Email adăugat cu succes')
                                ->success()
                                ->send();
                        }
                    }),
                    self::getSendEmailAction('sendAll', 'Trimite tuturor', fn() => PromoEmail::all())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                self::getSendEmailAction('send', 'Trimite individual', fn ($record) => collect([$record])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                self::getSendEmailBulkAction('sendAll', 'Trimite selectate', fn ($records) => $records),
            ]);
    }

    private static function getSendEmailAction(string $name, string $label, callable $getRecords): Action
    {
        return Action::make($name)
            ->label($label)
            ->icon('heroicon-o-paper-airplane')
            ->form(self::getSendEmailForm())
            ->action(function ($record, array $data) use ($getRecords): void {
                try {
                    SendPromoEmails::dispatch(
                        $getRecords($record),
                        $data['subject'],
                        $data['song_url'],
                        $data['download_url'],
                        $data['image_url']
                    );
    
                    FilamentNotification::make()
                        ->title("Job pentru trimiterea emailurilor a fost inițiat")
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Log::error("Eroare la trimiterea emailurilor: " . $e->getMessage());
                    FilamentNotification::make()
                        ->title("Eroare la trimiterea emailurilor")
                        ->danger()
                        ->send();
                }
            })
            ->requiresConfirmation();
    }

    private static function getSendEmailForm(): array
    {
        return [
            Forms\Components\TextInput::make('subject')
                ->label('Titlul Melodiei')
                ->required(),
            Forms\Components\TextInput::make('song_url')
                ->label('Song URL')
                ->required()
                ->url(),
            Forms\Components\TextInput::make('download_url')
                ->label('Download URL')
                ->url(),
            Forms\Components\TextInput::make('image_url')
                ->label('Image URL')
                ->url(),
        ];
    }

    private static function getStatusLabel(string $state): string
    {
        return [
            'pending' => 'În așteptare',
            'sent' => 'Trimis',
            'failed' => 'Eșuat',
        ][$state] ?? $state;
    }

    private static function getStatusColor(string $state): string
    {
        return [
            'pending' => 'warning',
            'sent' => 'success',
            'failed' => 'danger',
        ][$state] ?? 'primary';
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPromoEmails::route('/'),
            'edit' => EditPromoEmail::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
    private static function getSendEmailBulkAction(string $name, string $label, callable $getRecords): Tables\Actions\BulkAction
{
    return Tables\Actions\BulkAction::make($name)
        ->label($label)
        ->icon('heroicon-o-paper-airplane')
        ->form(self::getSendEmailForm())
        ->action(function (Collection $records, array $data) use ($getRecords): void {
            try {
                SendPromoEmails::dispatch(
                    $getRecords($records),
                    $data['subject'],
                    $data['song_url'],
                    $data['download_url'],
                    $data['image_url']
                );

                FilamentNotification::make()
                    ->title("Job pentru trimiterea emailurilor a fost inițiat")
                    ->success()
                    ->send();
            } catch (\Exception $e) {
                Log::error("Eroare la trimiterea emailurilor: " . $e->getMessage());
                FilamentNotification::make()
                    ->title("Eroare la trimiterea emailurilor")
                    ->danger()
                    ->send();
            }
        })
        ->requiresConfirmation();
}
}