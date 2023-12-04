<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumnusResource\Pages;
use App\Filament\Resources\AlumnusResource\RelationManagers;
use App\Models\Alumnus;
use App\Models\CFP;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumnusResource extends Resource
{
    protected static ?string $model = Alumnus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Elenco Alunni';
    protected static ?int $navigationSort = 4;

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Alunno');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Alunni');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Se l'utente è un CFP, mostra tutti gli Alunni che hanno creato le sue filiali
        if (auth()->user()->role_id == CFP) {
            return $query->whereHas('branch', function ($query) {
                $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
            });
        }
        else{
            // Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente
            return parent::getEloquentQuery()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id );
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('branch.name')->label('Sede')->searchable(isIndividual: true)->visible(fn (): bool => auth()->user()->role_id == CFP),
                Tables\Columns\TextColumn::make('name')->label('Nome')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('surname')->label('Cognome')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('address')->label('Indirizzo')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('phone')->label('Telefono')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('course_name')->label('Corso')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('tutor_name')->label('Tutor')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('start_date')->label('Data inizio')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('end_date')->label('Data fine')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('score')->label('Esito')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('camelot_sign_up_date')->label('Data Segnalazione a Camelot')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('camelot_sign_up_status')->label('Stato Iscrizione a Camelot')->sortable()->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('camelotRecruitmentProcessStep.name')->label('Stato percorso di assunzione')->sortable()->searchable()->toggleable(),
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
            'index' => Pages\ListAlumni::route('/'),
            'create' => Pages\CreateAlumnus::route('/create'),
            'edit' => Pages\EditAlumnus::route('/{record}/edit'),
        ];
    }
}
