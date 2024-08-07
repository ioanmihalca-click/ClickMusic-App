<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Video;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\VideoResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VideoResource\Pages\EditVideo;
use App\Filament\Resources\VideoResource\Pages\ListVideos;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Filament\Resources\VideoResource\Pages\CreateVideo;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $modelLabel = 'Videoclip';

    protected static ?string $pluralModelLabel = 'Videoclipuri';
    protected static ?int $navigationSort = 2; 

   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                Textarea::make('description')->required(),
                TextInput::make('embed_link')->required(),
                TextInput::make('thumbnail_url')->required()->url()->label("Thumbnail URL"),
                Toggle::make('featured')->label('Promovat')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail_url')->label('Thumbnail'),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('description')->limit('20'),  
                ToggleColumn::make('featured')->label('Promovat'), 
            ])
            ->filters([
                // ... (optional filters) ...
            ])
            ->actions([
                // EditAction::make(),
                // DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // ... (optional relation managers for comments and likes) ...
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }    
}