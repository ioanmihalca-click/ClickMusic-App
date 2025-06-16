<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Comment;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Megaphone\CommentReplyNotification;
use App\Filament\Resources\CommentResource\Pages\ListComments;


class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Comentarii';

    protected static ?int $navigationSort = 6;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilizator')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('video.thumbnail_url')
                    ->label('Videoclip')
                    ->circular()
                    ->width(40)
                    ->height(40)
                    ->tooltip(function (Comment $record): string {
                        return $record->video->title ?? 'Fără titlu';
                    }),
                TextColumn::make('body')
                    ->label('Conținut')
                    ->limit(10) // Limitează textul la 50 de caractere
                    ->tooltip(function (Comment $record): string {
                        $prefix = $record->reply_id ? '[Răspuns] ' : '';
                        return $prefix . $record->body;
                    }) // Adaugă un tooltip cu textul complet la hover
                    ->formatStateUsing(function (Comment $record) {
                        $prefix = $record->reply_id ? '[Răspuns] ' : '';
                        return $prefix . Str::limit($record->body, 10);
                    }),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d M Y H:i')
                    ->color('gray')
                    ->visibleFrom('md'),
            ])
            ->filters([
                SelectFilter::make('user')
                    ->relationship('user', 'name'),
                SelectFilter::make('video')
                    ->relationship('video', 'title'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('view_video')
                    ->label('Vezi videoclip')
                    ->url(fn(Comment $record): string => route('videos.show', $record->video))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('quick_reply')
                    ->label('Răspunde rapid')
                    ->form([
                        Textarea::make('reply')
                            ->label('Răspuns')
                            ->required(),
                    ])
                    ->action(function (Comment $record, array $data): void {
                        $reply = $record->replies()->create([
                            'body' => $data['reply'],
                            'user_id' => Auth::id(),
                            'video_id' => $record->video_id,
                        ]);


                        // Trigger Megaphone Notification (Here's the key change!)
                        $record->user->notify(new CommentReplyNotification($reply, $record->video));

                        Notification::make()
                            ->title('Răspuns adăugat cu succes')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}
