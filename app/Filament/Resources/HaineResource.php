<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HaineResource\Pages\CreateHaine;
use App\Filament\Resources\HaineResource\Pages\EditHaine;
use App\Filament\Resources\HaineResource\Pages\ListHaines;
use App\Models\Haina;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class HaineResource extends Resource
{
    protected static ?string $model = Haina::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Haine - Magazin';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('nume')
                            ->required()
                            ->maxLength(255)

                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255),

                        Select::make('categorie')
                            ->required()
                            ->options([
                                'tricou' => 'Tricou',
                                'hanorac' => 'Hanorac',
                            ]),

                        RichEditor::make('descriere')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan('full'),

                        TextInput::make('culoare')
                            ->required()
                            ->maxLength(255),

                        CheckboxList::make('marimi_disponibile')
                            ->label('Mărimi disponibile')
                            ->required()
                            ->options([
                                'XS' => 'XS',
                                'S' => 'S',
                                'M' => 'M',
                                'L' => 'L',
                                'XL' => 'XL',
                                'XXL' => 'XXL',
                            ])
                            ->columns(3),

                        TextInput::make('pret')
                            ->numeric()
                            ->required()
                            ->prefix('RON')
                            ->maxValue(42949672.95),

                        TextInput::make('price_id_stripe')
                            ->label('Price ID Stripe')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('imagine_produs')
                            ->label('Imagine produs')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->disk('public')
                            ->directory('haine/imagini')
                            ->required(),

                        Toggle::make('activ')
                            ->label('Produs activ')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagine_produs')
                    ->label('Imagine')
                    ->disk('public'),
                TextColumn::make('nume')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('categorie')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tricou' => 'success',
                        'hanorac' => 'info',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('culoare')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pret')
                    ->money('ron')
                    ->sortable(),
                IconColumn::make('activ')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('categorie')
                    ->options([
                        'tricou' => 'Tricou',
                        'hanorac' => 'Hanorac',
                    ]),
                TernaryFilter::make('activ')
                    ->label('Status produs'),
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
            'index' => ListHaines::route('/'),
            'create' => CreateHaine::route('/create'),
            'edit' => EditHaine::route('/{record}/edit'),
        ];
    }
}
