<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestQueryResource\Pages;
use App\Filament\Resources\GuestQueryResource\RelationManagers;
use App\Models\GuestQuery;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuestQueryResource extends Resource
{
    protected static ?string $model = GuestQuery::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // Перевод меток ресурса
    public static function getLabel(): ?string
    {
        return __('Guest Query'); // Единственное число
    }

    public static function getPluralLabel(): ?string
    {
        return __('Guest Queries'); // Множественное число
    }

    public static function getNavigationLabel(): string
    {
        return __('Guest Queries'); // Метка в навигации
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name')) // Перевод для поля "Имя"
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('Email')) // Перевод для поля "Электронная почта"
                    ->disabled()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label(__('Phone')) // Перевод для поля "Телефон"
                    ->disabled()
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->label(__('Company')) // Перевод для поля "Компания"
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label(__('Description')) // Перевод для поля "Описание"
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->label(__('Content')) // Перевод для поля "Содержание"
                    ->disabled()
                    ->rows(20)
                    ->required()
                    ->maxLength(2000)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company')
                    ->label(__('Company')) // Перевод для столбца "Компания"
                    ->searchable()
                    ->sortable(),
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
            ->defaultSort('created_at', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
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
            'index' => Pages\ListGuestQueries::route('/'),
            'edit' => Pages\EditGuestQuery::route('/{record}/edit'),
        ];
    }
}
