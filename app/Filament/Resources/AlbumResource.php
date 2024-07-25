<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Album;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AlbumResource\Pages;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    protected static ?string $navigationLabel = 'Albume - Magazin';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('titlu')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('descriere')
                            ->required()
                            ->maxLength(65535)
                            ->rows(5)
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('pret')
                            ->numeric()
                            ->required()
                            ->prefix('RON')
                            ->maxValue(42949672.95),
                        Forms\Components\DatePicker::make('data_lansare')
                            ->default(now())
                            ->required(),
                        Forms\Components\TextInput::make('gen_muzical')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('numar_trackuri')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Forms\Components\FileUpload::make('coperta_album')
                            ->label('Coperta')
                            ->image()
                            ->disk('public')
                            ->directory('albume/coperte')
                            ->required(),
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Fișier album (ZIP)')
                            ->disk('public')
                            ->directory('albume/fisiere')
                            ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed'])
                            ->required(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('coperta_album')
                    ->label('Coperta')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('titlu')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('gen_muzical')
                    ->searchable()
                    ->sortable()
                    ->width(150), 
                    Tables\Columns\TextColumn::make('pret')->money('ron')
                    ->sortable()
                    ->width(100),
                    Tables\Columns\TextColumn::make('data_lansare')
                    ->date()
                    ->sortable()
                    ->width(120),
                    
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gen_muzical'),
                Tables\Filters\Filter::make('data_lansare')
                    ->form([
                        Forms\Components\DatePicker::make('lansate_de_la')
                            ->label('Lansate de la'),
                        Forms\Components\DatePicker::make('lansate_pana_la')
                            ->label('Lansate până la'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['lansate_de_la'],
                                fn (Builder $query, $date): Builder => $query->whereDate('data_lansare', '>=', $date),
                            )
                            ->when(
                                $data['lansate_pana_la'],
                                fn (Builder $query, $date): Builder => $query->whereDate('data_lansare', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}