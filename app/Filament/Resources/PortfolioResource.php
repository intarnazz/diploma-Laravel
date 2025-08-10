<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // Перевод меток ресурса
    public static function getLabel(): ?string
    {
        return __('Portfolio'); // Единственное число
    }

    public static function getPluralLabel(): ?string
    {
        return __('Portfolios'); // Множественное число
    }

    public static function getNavigationLabel(): string
    {
        return __('Portfolios'); // Метка в навигации
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ViewField::make('image_preview')
                    ->label(__('Photo')) // Перевод для поля "Фото"
                    ->view('filament.components.image-preview')
                    ->viewData([
                        'width' => 0,
                        'height' => 500,
                    ])
                    ->columnSpanFull(),
                Hidden::make('image_id')
                    ->required(),
                FileUpload::make('upload')
                    ->label(__('Photo')) // Перевод для поля "Фото"
                    ->disk('public')
                    ->image()
                    ->visibility('public')
                    ->dehydrated(false)
                    ->saveUploadedFileUsing(fn() => null)
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
                    ->label(__('Title')) // Перевод для поля "Название"
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label(__('Description')) // Перевод для поля "Описание"
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('client')
                    ->label(__('Client')) // Перевод для поля "Клиент"
                    ->maxLength(255),
                Forms\Components\TextInput::make('completed_at')
                    ->label(__('Completed At')), // Перевод для поля "Дата завершения"
                Forms\Components\Textarea::make('notes')
                    ->label(__('Notes')) // Перевод для поля "Заметки"
                    ->maxLength(2000)
                    ->rows(20)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ViewColumn::make('path')
                    ->label(__('Photo')) // Перевод для столбца "Фото"
                    ->viewData([
                        'width' => 150,
                        'height' => 150,
                    ])
                    ->view('filament.components.image-preview'),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title')) // Перевод для столбца "Название"
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('Description')) // Перевод для столбца "Описание"
                    ->extraAttributes([
                        'style' => 'text-wrap: auto;',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At')) // Перевод для столбца "Дата создания"
                    ->dateTime()
                    ->searchable()
                    ->sortable(),
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
