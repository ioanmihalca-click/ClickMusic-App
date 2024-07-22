<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Comment;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CommentResource\Pages\ListComments;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Comentarii';

    protected static ?int $navigationSort = 5;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilizator')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('video.title')
                    ->label('Videoclip')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('body')
                    ->label('Comentariu')
                    ->limit(100)
                    ->html(),
                TextColumn::make('created_at')
                    ->label('Data comentariului')
                    ->dateTime(),
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
                    ->url(fn (Comment $record): string => route('videos.show', $record->video))
                    ->openUrlInNewTab(),

                    Tables\Actions\Action::make('quick_reply')
    ->label('Răspunde rapid')
    ->form([
        Textarea::make('reply')
            ->label('Răspuns')
            ->required(),
    ])
    ->action(function (Comment $record, array $data) {
        // Logica pentru a adăuga un răspuns rapid
        $record->replies()->create([
            'body' => $data['reply'],
            'user_id' => auth()->id(),
            'video_id' => $record->video_id,
        ]);
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
