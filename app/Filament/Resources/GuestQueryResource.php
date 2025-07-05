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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->disabled()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->disabled()
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')->disabled()
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')->disabled()
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
//                Tables\Columns\TextColumn::make('name'),
//                Tables\Columns\TextColumn::make('email'),
//                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('company')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->extraAttributes([
                    'style' => 'text-wrap: auto;',
                ])->searchable(),
//                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()->searchable()->sortable(),
//                Tables\Columns\TextColumn::make('updated_at')
//                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'asc')
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGuestQueries::route('/'),
//            'create' => Pages\CreateGuestQuery::route('/create'),
            'edit' => Pages\EditGuestQuery::route('/{record}/edit'),
        ];
    }
}
