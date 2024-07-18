<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Comment;
use App\Filament\Resources\CommentResource\Pages\ListComments;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Comentarii';

    protected static ?int $navigationSort = 4;

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