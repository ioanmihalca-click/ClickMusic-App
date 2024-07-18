<?php

// app/Filament/Resources/PostResource.php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Postari pe blog';
    protected static ?int $navigationSort = 3; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
               
                Forms\Components\TextInput::make('meta')
                    ->required(),
                    Forms\Components\RichEditor::make('body')->columnSpanFull()
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
            ]);
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
            // 'view' => ViewPost::route('/{record}'),
            // 'edit' => EditPost::route('/{record}/edit'),
        ];
    }    
}
