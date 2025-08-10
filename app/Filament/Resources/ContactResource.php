<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // Перевод меток ресурса
    public static function getLabel(): ?string
    {
        return __('Contact'); // Ключ перевода для единственного числа
    }

    public static function getPluralLabel(): ?string
    {
        return __('Contacts'); // Ключ перевода для множественного числа
    }

    public static function getNavigationLabel(): string
    {
        return __('Contacts'); // Ключ перевода для навигации
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name')) // Используем ключ перевода
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label(__('Description')) // Используем ключ перевода
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('link')
                    ->label(__('Link')) // Используем ключ перевода
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')), // Перевод столбца
                Tables\Columns\TextColumn::make('description')
                    ->label(__('Description')), // Перевод столбца
                Tables\Columns\TextColumn::make('link')
                    ->label(__('Link')), // Перевод столбца
            ])
            ->filters([
                //
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
