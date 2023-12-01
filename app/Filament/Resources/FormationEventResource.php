<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormationEventResource\Pages;
use App\Filament\Resources\FormationEventResource\RelationManagers;
use App\Models\FormationEvent;
use App\Models\CFP;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Tutor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormationEventResource extends Resource
{
    protected static ?string $model = FormationEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Eventi Formativi';

    public static function form(Form $form): Form
    {
        $currentUserId = auth()->id();
        $currentBranch = Branch::where('user_id', '=', $currentUserId)->first();
        $parentCFP = CFP::where('id', '=', $currentBranch->cfp_id)->first();

        return $form
            ->schema([
                //
                Forms\Components\Select::make('course_id')
                    ->required()
                    ->label('Corso tenuto')
                    ->searchable()
                    //->live()
                    ->default(Course::where('cfp_id', '=', $parentCFP->id)->first()->id)
                    ->options(Course::where('cfp_id', '=', $parentCFP->id)->pluck('name', 'id')),
                //                Forms\Components\TextInput::make('name')
                //                    ->required()
                //                    ->label('Nome'),
                Forms\Components\Select::make('tutor_id')
                    ->required()
                    ->label('Tutor')
                    ->options(Tutor::where('branch_id', '=', $currentBranch->id)->pluck('name', 'id')),
                Forms\Components\TextInput::make('actual_price')
                    ->required()
                    ->numeric()
                    //->reactive()
                    ->placeholder(fn (Get $get) => Course::find($get('course_id'))->list_price)
                    ->label('Costo effettivo'),
                Forms\Components\TextInput::make('max_students')
                    ->numeric()
                    ->label('Massimo numero di studenti'),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->label('Data inizio'),
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->label('Data fine'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')->label('Codice Evento')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('course.name')->label('Corso tenuto')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('course.code')->label('Codice Corso')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('tutor.name')->label('Tutor')->sortable()->searchable(isIndividual: true),
                //Tables\Columns\TextColumn::make('description')->label('Descrizione'),
                Tables\Columns\TextColumn::make('start_date')->label('Data inizio'),
                Tables\Columns\TextColumn::make('end_date')->label('Data fine'),
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
            'index' => Pages\ListFormationEvents::route('/'),
            'create' => Pages\CreateFormationEvent::route('/create'),
            'edit' => Pages\EditFormationEvent::route('/{record}/edit'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
