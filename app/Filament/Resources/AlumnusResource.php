<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumnusResource\Pages;
use App\Filament\Resources\AlumnusResource\RelationManagers;
use App\Models\Alumnus;
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
                Tables\Columns\TextColumn::make('branch.name')->label('Sede')->sortable()->searchable()->toggleable(),
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
