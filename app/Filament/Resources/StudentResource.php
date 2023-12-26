<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Branch;
use App\Models\CFP;
use App\Models\FormationEvent;
use App\Models\Student;
use App\Models\StudentStatus;
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
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\ActionsPosition;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'ADS Corsi';
    protected static ?int $navigationSort = 8;

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Segnalazione Corso');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Segnalazioni Corsi');
    }

    // Filter resource instances based on owner
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Se l'utente è un CFP, mostra tutti gli Alunni che hanno creato le sue filiali
        if (auth()->user()->role_id == 1) {
            return $query->whereHas('formationEvent.branch', function ($query) {
                $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
            });
        }

        // Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente
        return parent::getEloquentQuery()->whereHas('formationEvent', function($query){
            $query->where('branch_id', Branch::where('user_id', auth()->id())->first()->id );
        });
    }

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
                    ->options(FormationEvent::all()->pluck('name', 'id')),
                Forms\Components\DatePicker::make('parsifal_enrolled_at')
                    //->label('Data Registrazione Parsifal'),
                    ->label('Data Variazione Dati')
                    ->required(),
                Forms\Components\TextInput::make('origin_id')
                    ->default('2')
                    ->disabled()
                    ->hidden(),
                Forms\Components\Select::make('student_status_id')
                    ->required()
                    ->searchable()
                    ->options(StudentStatus::all()->pluck('name', 'id'))
                    ->label('Stato Contatto'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('formationEvent.branch.name')->label('Sede')->searchable(isIndividual: true)->visible(fn (): bool => auth()->user()->role_id == CFP),
                Tables\Columns\TextColumn::make('name')->label('Nome')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')->label('Email')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('status.name')->label('Stato Contatto')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parsifal_enrolled_at')
                    //->label('Data Iscrizione Parsifal')
                    ->label('Data Variazione')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('formationEvent.course.name')->label('Corso in Programma')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->label(''),
                Action::make('viewCurriculum')
                    ->icon('heroicon-m-eye')
                    //->label('Curriculum')
                    ->label('')
                    ->modalContent(fn (Student $record) => view('students.show-cv', ['collection' => $record]))
                    ->modalWidth('7xl')
                    ->modalSubmitAction(false),
            ], position: ActionsPosition::BeforeColumns)
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
            // 'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
