<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Haina;
use Pages\EditHaines;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\HainaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HaineResource\Pages\EditHaine;
use App\Filament\Resources\HaineResource\Pages\ListHaines;
use App\Filament\Resources\HaineResource\Pages\CreateHaine;

class HaineResource extends Resource
{
    protected static ?string $model = Haina::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Haine - Magazin';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nume')
                            ->required()
                            ->maxLength(255)

                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('categorie')
                            ->required()
                            ->options([
                                'tricou' => 'Tricou',
                                'hanorac' => 'Hanorac',
                            ]),

                        RichEditor::make('descriere')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpan('full'),

                        Forms\Components\TextInput::make('culoare')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\CheckboxList::make('marimi_disponibile')
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

                        Forms\Components\TextInput::make('pret')
                            ->numeric()
                            ->required()
                            ->prefix('RON')
                            ->maxValue(42949672.95),

                        Forms\Components\TextInput::make('price_id_stripe')
                            ->label('Price ID Stripe')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('imagine_produs')
                            ->label('Imagine produs')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->disk('public')
                            ->directory('haine/imagini')
                            ->required(),

                        Forms\Components\Toggle::make('activ')
                            ->label('Produs activ')
                            ->default(true),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('imagine_produs')
                    ->label('Imagine')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('nume')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categorie')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'tricou' => 'success',
                        'hanorac' => 'info',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('culoare')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pret')
                    ->money('ron')
                    ->sortable(),
                Tables\Columns\IconColumn::make('activ')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categorie')
                    ->options([
                        'tricou' => 'Tricou',
                        'hanorac' => 'Hanorac',
                    ]),
                Tables\Filters\TernaryFilter::make('activ')
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
