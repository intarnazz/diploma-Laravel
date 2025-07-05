<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;


class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ViewField::make('image_preview')
                    ->label('Фото')
                    ->view('filament.components.image-preview')
                    ->viewData([
                        'width' => 0,
                        'height' => 500,
                    ])
                    ->columnSpanFull(), // чтобы картинка растягивалась
                Hidden::make('image_id')
                    ->required(),
                FileUpload::make('upload')
                    ->label('Фото')
                    ->disk('public')
                    ->image()
                    ->visibility('public')
                    ->dehydrated(false)
//                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state instanceof \Livewire\TemporaryUploadedFile) {
                            $storedPath = $state->store('', 'public');
                            $image = \App\Models\Image::create([
                                'path' => $storedPath,
                            ]);
                            $set('image_id', $image->id);
                        }
                    }),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('client')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('completed_at'),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->rows(20)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('path')
                    ->label('Фото')
                    ->viewData([
                        'width' => 150,
                        'height' => 150,
                    ])
                    ->view('filament.components.image-preview'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')->extraAttributes([
                    'style' => 'text-wrap: auto;',
                ])->searchable(),
//                Tables\Columns\TextColumn::make('client'),
//                Tables\Columns\TextColumn::make('completed_at')
//                    ->date(),
//                Tables\Columns\TextColumn::make('notes'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->searchable()->sortable(),
//                Tables\Columns\TextColumn::make('updated_at')
//                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
