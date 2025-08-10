<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // Перевод меток ресурса
    public static function getLabel(): ?string
    {
        return __('User'); // Единственное число
    }

    public static function getPluralLabel(): ?string
    {
        return __('Users'); // Множественное число
    }

    public static function getNavigationLabel(): string
    {
        return __('Users'); // Метка в навигации
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name')) // Перевод для поля "Имя"
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('Email')) // Перевод для поля "Электронная почта"
                    ->disabled()
                    ->email()
                    ->required()
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
                Forms\Components\TextInput::make('role')
                    ->label(__('Role')) // Перевод для поля "Роль"
                    ->disabled()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')), // Перевод для столбца "Имя"
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email')), // Перевод для столбца "Электронная почта"
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone')), // Перевод для столбца "Телефон"
                Tables\Columns\TextColumn::make('company')
                    ->label(__('Company')), // Перевод для столбца "Компания"
                Tables\Columns\TextColumn::make('role')
                    ->label(__('Role')), // Перевод для столбца "Роль"
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At')) // Перевод для столбца "Дата создания"
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated At')) // Перевод для столбца "Дата обновления"
                    ->dateTime(),
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
