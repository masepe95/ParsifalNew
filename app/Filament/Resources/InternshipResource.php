<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipResource\Pages;
use App\Filament\Resources\InternshipResource\RelationManagers;
use App\Models\Branch;
use App\Models\CFP;
use App\Models\Internship;
use App\Models\InternshipStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IntershipsExports;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Fieldset;

class InternshipResource extends Resource
{
    protected static ?string $model = Internship::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'ADS Tirocini';
    protected static ?int $navigationSort = 9;

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Tirocinio');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Tirocini');
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
                Forms\Components\TextInput::make('name')
                    ->label('Ragione Sociale')
                    ->required(),
//                Forms\Components\TextInput::make('camelotCandidate.name')
//                    ->label('Nome Tirocinante')
//                    ->extraInputAttributes(['readonly' => true]),
//                Forms\Components\Fieldset::make('camelotCandidateName')
//                Forms\Components\TextInput::make('camelotCandidate')
//                    ->relationship('camelotCandidate')
//                    ->schema([
//                        Forms\Components\TextInput::make('name')
//                            ->label('Nome Tirocinante')
//                            ->extraInputAttributes(['readonly' => true]),
//                    ])
//                   ,

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->label('E-Mail')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Telefono'),
                Forms\Components\DatePicker::make('parsifal_enrolled_at')
                    //->label('Data Registrazione Parsifal'),
                    ->label('Data Variazione Dati')
                    ->required(),
                Forms\Components\Select::make('internship_status_id')
                    ->required()
                    ->searchable()
                    ->options(InternshipStatus::all()->pluck('name', 'id'))
                    ->label('Stato Contatto'),
            ]);    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('branch.name')->label('Sede')->searchable(isIndividual: true)->visible(fn (): bool => auth()->user()->role_id == CFP),
                //Tables\Columns\TextColumn::make('camelotCompanyProfile.name')->label('Azienda'),
                //Tables\Columns\TextColumn::make('camelot_company_id')->label('Id Azienda in Camelot'),
                //Tables\Columns\TextColumn::make('camelot_company_match_id')->label('Camelot Match Id'),
                Tables\Columns\TextColumn::make('camelotCandidate.name')->label('Nome Tirocinante'),
                Tables\Columns\TextColumn::make('name')->label('Ragione Sociale Azienda')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')->label('Email')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('phone')->label('Telefono'),
                Tables\Columns\TextColumn::make('created_at')->sortable()->label('Data Segnalazione in Parsifal'),
                Tables\Columns\TextColumn::make('status.name')->label('Stato Contatto')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parsifal_enrolled_at')
                    //->label('Data Attivazione Tirocinio')
                    ->label('Data Variazione')
                    ->badge(),
                //Tables\Columns\TextColumn::make('updated_at')
                ])
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\EditAction::make()
                    ->label(''),
                ], position: ActionsPosition::BeforeColumns)
                ->bulkActions([

                BulkAction::make('Enroll')
                    ->label('Iscrivi Ora')
                    ->visible(function () {
                        return auth()->user()->role_id != CFP;
                    })
                    ->action(function (Collection $records) {
                        $records->each(function (Internship $internship) {
                            $internship->update([
                                'parsifal_enrolled_at' => Carbon::now(),
                                'internship_status_id' => ENROLLED,
                            ]);
                        });
                    }),
                BulkAction::make('exportExcel')
                    ->label('Esporta in Excel')
                    ->action(function ($records) {
                        $recordIds = $records->pluck('id')->toArray();

                        $export = new IntershipsExports($recordIds);
                        return Excel::download($export, 'internships.xlsx');
                    })
                    ->deselectRecordsAfterCompletion(),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\CamelotCandidateRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInternships::route('/'),
            // 'create' => Pages\CreateInternship::route('/create'),
            'edit' => Pages\EditInternship::route('/{record}/edit'),
        ];
    }
}
