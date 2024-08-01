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
                    ->required()
                    ->maxLength(255),
                TextInput::make('recipient_email')
                    ->label('Adresă Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
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
                self::getSendNewsletterAction('sendAll', 'Trimite tuturor', fn() => Newsletter::all())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                self::getSendNewsletterAction('send', 'Trimite individual', fn ($record) => collect([$record])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                self::getSendNewsletterBulkAction('sendAll', 'Trimite selectate', fn ($records) => $records),
            ]);
    }

    private static function getSendNewsletterAction(string $name, string $label, callable $getRecords): Action
{
    return Action::make($name)
        ->label($label)
        ->icon('heroicon-o-paper-airplane')
        ->form(self::getSendNewsletterForm())
            ->action(function ($record, array $data) use ($getRecords): void {
                try {
                    SendNewsletters::dispatch(
                        $getRecords($record),
                        $data['subject'],
                        $data['content']
                    );
    
                    FilamentNotification::make()
                        ->title("Job pentru trimiterea newsletterului a fost inițiat")
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Log::error("Eroare la trimiterea newsletterului: " . $e->getMessage());
                    FilamentNotification::make()
                        ->title("Eroare la trimiterea newsletterului")
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
            Forms\Components\TextInput::make('subject')
                ->label('Subiect Newsletter')
                ->required(),
            Forms\Components\RichEditor::make('content')
                ->label('Conținut Newsletter')
                ->required(),
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

    private static function getSendNewsletterBulkAction(string $name, string $label, callable $getRecords): Tables\Actions\BulkAction
    {
        return Tables\Actions\BulkAction::make($name)
            ->label($label)
            ->icon('heroicon-o-paper-airplane')
            ->form(self::getSendNewsletterForm())
            ->action(function (Collection $records, array $data) use ($getRecords): void {
                try {
                    SendNewsletters::dispatch(
                        $getRecords($records),
                        $data['subject'],
                        $data['content']
                    );

                    FilamentNotification::make()
                        ->title("Job pentru trimiterea newsletterului a fost inițiat")
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Log::error("Eroare la trimiterea newsletterului: " . $e->getMessage());
                    FilamentNotification::make()
                        ->title("Eroare la trimiterea newsletterului")
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
            // 'create' => CreateNewsletter::route('/create'),
            'edit' => EditNewsletter::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
{
    return false;
}
}