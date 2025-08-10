<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // Перевод меток ресурса
    public static function getLabel(): ?string
    {
        return __('Service'); // Единственное число
    }

    public static function getPluralLabel(): ?string
    {
        return __('Services'); // Множественное число
    }

    public static function getNavigationLabel(): string
    {
        return __('Services'); // Метка в навигации
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name')) // Перевод для поля "Название"
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label(__('Price')) // Перевод для поля "Цена"
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->label(__('Type')) // Перевод для поля "Тип"
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')) // Перевод для столбца "Название"
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price')) // Перевод для столбца "Цена"
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type')) // Перевод для столбца "Тип"
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created At')) // Перевод для столбца "Дата создания"
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('type', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
