<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\FormationEvent;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Studenti';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome e Cognome')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('E-Mail')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefono'),
                Forms\Components\Select::make('formation_event_id')
                    ->required()
                    ->label('Evento Formazione')
                    ->options(FormationEvent::all()->pluck('start_date', 'id')),
                Forms\Components\DatePicker::make('parsifal_enrolled_at')
                    ->label('Data Registrazione Parsifal'),
                Forms\Components\TextInput::make('origin_id')
                    ->default('2')
                    ->disabled()
                    ->hidden()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('parsifal_enrolled_at')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('formationEvent.course.name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('Enroll')
                    ->label('Iscrivi Ora')
                    ->visible(function () {
                        return auth()->user()->role_id != 1;
                    })
                    ->action(function (Collection $records) {
                        $records->each(function (Student $student) {
                            $student->update([
                                'parsifal_enrolled_at' => Carbon::now(),
                            ]);
                        });
                    }),
                BulkAction::make('exportExcel')
                    ->label('Esporta in Excel')
                    ->action(function ($records) {
                        $recordIds = $records->pluck('id')->toArray();

                        $export = new StudentsExport($recordIds);
                        return Excel::download($export, 'students.xlsx');
                    })
                    ->deselectRecordsAfterCompletion(),

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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
