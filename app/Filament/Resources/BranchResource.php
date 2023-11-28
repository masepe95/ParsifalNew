<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User; // required to search for unique Account emails (access via email/password)

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nome Filiale'),
                Forms\Components\TextInput::make('email')
                    ->email()->unique(table: User::class)
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password di accesso')
                    ->password()
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->label('Indirizzo'),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->label('Località'),
                Forms\Components\TextInput::make('district')
                    ->required()
                    ->label('Provincia'),
                Forms\Components\TextInput::make('postal_code')
                    ->required()
                    ->label('C.A.P.'),
                Forms\Components\TextInput::make('manager_name')
                    ->required()
                    ->label('Nome Referente'),
                Forms\Components\TextInput::make('manager_surname')
                    ->required()
                    ->label('Cognome Referente'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->label('Telefono'),
                Forms\Components\TextArea::make('description')
                    ->label('Breve Descrizione'),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
