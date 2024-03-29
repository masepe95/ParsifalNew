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
    protected static ?string $navigationLabel = 'Profili Sedi Operative';
    protected static ?int $navigationSort = 3;

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Sede Operativa');
    }

     public static function getPluralModelLabel(): string
    {
        return __('Sedi Operative');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nome Sede'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(table: User::class)
                    //->disabledOn ('edit') // we don't want to change the account "username"
                    ->hiddenOn('edit')
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password di accesso')
                    ->password()
                    //->placeholder('********')
                    //->hiddenOn('edit')
                    ->visible(fn (): bool => auth()->user()->role_id == CFP)
                    ->required(fn (string $operation): bool => $operation === 'create'),
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
                    ->maxLength(2)
                    ->label('C.A.P.'),
                Forms\Components\TextInput::make('manager_name')
                    ->required()
                    ->maxLength(5)
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
            ->striped()
            ->columns([
                //
//                Tables\Columns\TextColumn::make('id'),
//                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('name')->label('Nome Sede'),
                Tables\Columns\TextColumn::make('address')
                    ->formatStateUsing(function ($state, Branch $branch) {
                        return $branch->address . ', ' . $branch->city;})
                    ->label('Indirizzo Sede'),
                Tables\Columns\TextColumn::make('manager_surname')
                    ->formatStateUsing(function ($state, Branch $branch) {
                        return $branch->manager_name . ' ' . $branch->manager_surname;})
                    ->label('Referente'),
                Tables\Columns\TextColumn::make('email')->label('Email (username di accesso)'),
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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Se l'utente è un CFP, mostra tutti i Branch che ha creato
        if (auth()->user()->role_id == CFP) {
            return $query->whereHas('cfp', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }

        // Altrimenti, mostra solo i Branch associati direttamente all'utente
        return $query->where('user_id', auth()->id());
    }
}
