<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipResource\Pages;
use App\Filament\Resources\InternshipResource\RelationManagers;
use App\Models\Branch;
use App\Models\CFP;
use App\Models\Internship;
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
use App\Exports\IntershipsExports;
use Filament\Tables\Actions\Action;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('branch.name')->label('Sede')->searchable(isIndividual: true)->visible(fn (): bool => auth()->user()->role_id == CFP),
                //Tables\Columns\TextColumn::make('camelotCompanyProfile.name')->label('Azienda'),
                Tables\Columns\TextColumn::make('camelot_company_id')->label('Id Azienda in Camelot'),
                Tables\Columns\TextColumn::make('camelot_match_id')->label('Camelot Match Id'),
                Tables\Columns\TextColumn::make('name')->label('Ragione Sociale Azienda')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')->label('Email')
                    ->sortable()
                    ->toggleable()
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('phone')->label('Telefono'),
                Tables\Columns\TextColumn::make('parsifal_enrolled_at')
                    ->label('Data Attivazione Tirocinio')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')->label('Data Segnalazione in Parsifal'),
                //Tables\Columns\TextColumn::make('updated_at')
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
                        $records->each(function (Internship $internship) {
                            $internship->update([
                                'parsifal_enrolled_at' => Carbon::now(),
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
