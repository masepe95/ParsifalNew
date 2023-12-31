<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TutorResource\Pages;
use App\Filament\Resources\TutorResource\RelationManagers;
use App\Models\Branch;
use App\Models\CFP;
use App\Models\Tutor;
use App\Models\TutorType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tutor/Operatori';
    protected static ?int $navigationSort = 6;

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Tutor / Operatore');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Tutor / Operatori');
    }

    // Filter resource instances based on owner
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Se l'utente è un CFP, mostra tutti gli Alunni che hanno creato le sue filiali
        if (auth()->user()->role_id == 1) {
            return $query->whereHas('branch', function ($query) {
                $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
            });
        }

        // Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente
        return parent::getEloquentQuery()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id );
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nome'),
                Forms\Components\TextInput::make('surname')
                    ->required()
                    ->label('Cognome'),
                Forms\Components\Textarea::make('description')
                    ->label('Descrizione'),
                Forms\Components\Select::make('tutor_type_id')
                    ->required()
                    ->searchable()
                    ->options(TutorType::all()->pluck('name', 'id'))
                    ->label('Tipo di Collaborazione'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('Email'),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefono'),
                Forms\Components\DatePicker::make('available_from')
                    ->label('Disponibile dal'),
                Forms\Components\DatePicker::make('available_until')
                    ->label('Disponibile al'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                //
                //Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('branch.name')->label('Sede')->searchable(isIndividual: true)->visible(fn (): bool => auth()->user()->role_id == CFP),
                Tables\Columns\TextColumn::make('surname')->label('Cognome'),
                Tables\Columns\TextColumn::make('description')->label('Descrizione'),
                Tables\Columns\TextColumn::make('available_from')->label('Disponibile dal'),
                Tables\Columns\TextColumn::make('available_until')->label('Disponibile al'),
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
            'index' => Pages\ListTutors::route('/'),
            'create' => Pages\CreateTutor::route('/create'),
            'edit' => Pages\EditTutor::route('/{record}/edit'),
        ];
    }
}
