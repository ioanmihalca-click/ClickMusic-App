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
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Abonați Newsletter';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?int $navigationSort = 8;
    protected static ?string $modelLabel = 'Abonat Newsletter';
    protected static ?string $pluralModelLabel = 'Abonați Newsletter';
    protected static ?string $recordTitleAttribute = 'recipient_email';
    protected static ?string $slug = 'newsletter-subscribers';
    protected static ?string $description = 'Gestionează lista de abonați la newsletter';

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
                Forms\Components\Select::make('status')
                    ->label('Status Abonare')
                    ->options([
                        Newsletter::STATUS_PENDING => 'Abonat',
                        Newsletter::STATUS_FAILED => 'Dezabonat',
                    ])
                    ->default(Newsletter::STATUS_PENDING)
                    ->required(),
                Forms\Components\Toggle::make('is_user')
                    ->label('Este utilizator înregistrat?')
                    ->default(false)
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(function (Newsletter $record) {
                        return \App\Models\User::where('email', $record->recipient_email)->exists();
                    }),
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
                    ->label('Adaugă Abonat Newsletter')
                    ->icon('heroicon-o-plus'),

                // Import din CSV
                Tables\Actions\Action::make('importCsv')
                    ->label('Import CSV')
                    ->icon('heroicon-o-document-arrow-up')
                    ->color('info')
                    ->form([
                        Forms\Components\FileUpload::make('csv_file')
                            ->label('Fișier CSV')
                            ->acceptedFileTypes(['text/csv', '.csv'])
                            ->required()
                            ->helperText('Format așteptat: nume,email (fără header)'),
                        Forms\Components\Toggle::make('skip_duplicates')
                            ->label('Omite duplicatele')
                            ->default(true),
                    ])
                    ->action(function (array $data): void {
                        // Procesăm fișierul CSV pentru import
                        static::processCsvImport($data);
                    }),

                // Export la CSV
                Tables\Actions\Action::make('exportCsv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function (): \Symfony\Component\HttpFoundation\BinaryFileResponse {
                        return static::exportToCsv();
                    }),

                // Statistici rapide
                Tables\Actions\Action::make('stats')
                    ->label('Statistici')
                    ->icon('heroicon-o-chart-bar')
                    ->color('gray')
                    ->modalContent(fn() => view('filament.newsletter-subscriber-stats'))
                    ->modalWidth('md')
                    ->slideOver(),
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

                // Toggle subscription cu confirmări
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
                    ->requiresConfirmation()
                    ->modalHeading(fn ($record) => $record->status === Newsletter::STATUS_PENDING ? 'Dezabonare' : 'Reabonare')
                    ->modalDescription(fn ($record) => $record->status === Newsletter::STATUS_PENDING
                        ? "Sigur vrei să dezabonezi {$record->recipient_email}?"
                        : "Sigur vrei să reabonezi {$record->recipient_email}?")
                    ->action(function ($record) {
                        if ($record->status === Newsletter::STATUS_PENDING) {
                            $record->markAsFailed('Dezabonat manual din admin');
                            \Filament\Notifications\Notification::make()
                                ->title('Abonat dezabonat')
                                ->success()
                                ->send();
                        } else {
                            $record->resetToPending();
                            \Filament\Notifications\Notification::make()
                                ->title('Abonat reactivat')
                                ->success()
                                ->send();
                        }
                    }),

                // Trimite email de test
                Tables\Actions\Action::make('send_test_email')
                    ->label('Test Email')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->form([
                        Forms\Components\TextInput::make('test_subject')
                            ->label('Subiect')
                            ->default('Test Email de la Click Music')
                            ->required(),
                        Forms\Components\Textarea::make('test_message')
                            ->label('Mesaj')
                            ->default('Acesta este un email de test pentru a verifica că adresa funcționează corect.')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function ($record, array $data): void {
                        static::sendTestEmail($record, $data);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    // Reabonare în masă
                    Tables\Actions\BulkAction::make('bulk_resubscribe')
                        ->label('Reabonează selectați')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records): void {
                            $count = 0;
                            $records->each(function ($record) use (&$count) {
                                if ($record->status !== Newsletter::STATUS_PENDING) {
                                    $record->resetToPending();
                                    $count++;
                                }
                            });
                            \Filament\Notifications\Notification::make()
                                ->title("Reabonați {$count} utilizatori")
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),

                    // Dezabonare în masă
                    Tables\Actions\BulkAction::make('bulk_unsubscribe')
                        ->label('Dezabonează selectați')
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records): void {
                            $count = 0;
                            $records->each(function ($record) use (&$count) {
                                if ($record->status === Newsletter::STATUS_PENDING) {
                                    $record->markAsFailed('Dezabonat manual în masă din admin');
                                    $count++;
                                }
                            });
                            \Filament\Notifications\Notification::make()
                                ->title("Dezabonați {$count} utilizatori")
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),
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
     * Aplicăm modificări pentru a putea afișa în tabel doar subscribers din newsletter table
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('campaign_type', Newsletter::TYPE_SUBSCRIBER);
    }

    /**
     * Procesează import CSV
     */
    private static function processCsvImport(array $data): void
    {
        try {
            $csvPath = storage_path('app/' . $data['csv_file']);
            $skipDuplicates = $data['skip_duplicates'] ?? true;

            if (!file_exists($csvPath)) {
                \Filament\Notifications\Notification::make()
                    ->title('Eroare')
                    ->body('Fișierul CSV nu a fost găsit')
                    ->danger()
                    ->send();
                return;
            }

            $imported = 0;
            $skipped = 0;
            $errors = 0;

            $file = fopen($csvPath, 'r');
            while (($row = fgetcsv($file)) !== false) {
                if (count($row) < 2) {
                    $errors++;
                    continue;
                }

                $name = trim($row[0]);
                $email = trim($row[1]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors++;
                    continue;
                }

                // Verificăm duplicatele
                if ($skipDuplicates && Newsletter::where('recipient_email', $email)->exists()) {
                    $skipped++;
                    continue;
                }

                Newsletter::create([
                    'recipient_name' => $name,
                    'recipient_email' => $email,
                    'status' => Newsletter::STATUS_PENDING,
                    'campaign_type' => Newsletter::TYPE_SUBSCRIBER,
                ]);

                $imported++;
            }

            fclose($file);

            \Filament\Notifications\Notification::make()
                ->title('Import finalizat')
                ->body("Importați: {$imported}, Omisi: {$skipped}, Erori: {$errors}")
                ->success()
                ->send();

        } catch (\Exception $e) {
            \Filament\Notifications\Notification::make()
                ->title('Eroare la import')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    /**
     * Export la CSV
     */
    private static function exportToCsv(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $filename = 'newsletter-subscribers-' . date('Y-m-d-H-i-s') . '.csv';
        $path = storage_path('app/' . $filename);

        $file = fopen($path, 'w');

        // Header CSV
        fputcsv($file, ['Nume', 'Email', 'Status', 'Data Creării']);

        // Date
        Newsletter::subscribers()->orderBy('created_at')->chunk(1000, function ($subscribers) use ($file) {
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->recipient_name,
                    $subscriber->recipient_email,
                    $subscriber->status === Newsletter::STATUS_PENDING ? 'Abonat' : 'Dezabonat',
                    $subscriber->created_at->format('Y-m-d H:i:s'),
                ]);
            }
        });

        fclose($file);

        return response()->download($path)->deleteFileAfterSend();
    }

    /**
     * Trimite email de test
     */
    private static function sendTestEmail(Newsletter $record, array $data): void
    {
        try {
            \Illuminate\Support\Facades\Mail::send([], [], function (\Illuminate\Mail\Message $message) use ($record, $data) {
                $message->from('contact@clickmusic.ro', 'Click Music Ro')
                    ->to($record->recipient_email, $record->recipient_name)
                    ->subject($data['test_subject'])
                    ->html(
                        '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">' .
                        '<h2 style="color: #333;">' . htmlspecialchars($data['test_subject']) . '</h2>' .
                        '<p style="color: #666; line-height: 1.6;">' . nl2br(htmlspecialchars($data['test_message'])) . '</p>' .
                        '<hr style="margin: 30px 0; border: none; border-top: 1px solid #eee;">' .
                        '<p style="color: #999; font-size: 12px;">Acesta este un email de test trimis din sistemul de administrare.</p>' .
                        '</div>'
                    );
            });

            \Filament\Notifications\Notification::make()
                ->title('Email de test trimis')
                ->body("Trimis către {$record->recipient_email}")
                ->success()
                ->send();

        } catch (\Exception $e) {
            \Filament\Notifications\Notification::make()
                ->title('Eroare la trimiterea email-ului')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
