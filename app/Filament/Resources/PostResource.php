<?php

// app/Filament/Resources/PostResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Blog';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('meta.title')->label('Meta Title')->required(),
                Forms\Components\Textarea::make('meta.description')->label('Meta Description')->required(),
                Forms\Components\MarkdownEditor::make('body')->columnSpanFull()
                    ->required(),
                Forms\Components\FileUpload::make('featured_image')->disk('public')->directory('blog-images')
                    ->required()
                    ->image(),
                DatePicker::make('published_at')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image'),
                TextColumn::make('title')->sortable()->searchable()->limit('20'),
                // TextColumn::make('body')->limit('20'),
                TextColumn::make('meta')->searchable()->limit('20'),
                TextColumn::make('published_at')
                    ->dateTime(),

            ])
            ->filters([
                // ... (optional filters) ...
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // ... (optional relation managers for categories, tags, etc.) ...
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
