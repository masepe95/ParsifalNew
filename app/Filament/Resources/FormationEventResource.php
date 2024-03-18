<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormationEventResource\Pages;
use App\Filament\Resources\FormationEventResource\RelationManagers;
use App\Models\CourseType;
use App\Models\FormationEvent;
use App\Models\CFP;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Tutor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormationEventResource extends Resource
{
    protected static ?string $model = FormationEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Programma Corsi';
    protected static ?int $navigationSort = 7;


    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Evento Formativo');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Eventi Formativi');
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
        $currentUserId = auth()->id();
        $currentBranch = Branch::where('user_id', '=', $currentUserId)->first();
        $parentCFP = CFP::where('id', '=', $currentBranch->cfp_id)->first();

        return $form
            ->schema([
                //
                Forms\Components\Select::make('course_id')
                    ->required()
                    ->label('Argomento (Catalogo Corsi)')
                    ->searchable()
                    //->default(Course::where('cfp_id', '=', $parentCFP->id)->first()->id)
                    ->options(Course::where('cfp_id', '=', $parentCFP->id)->pluck('name', 'id'))
                    //->reactive(),
                    ->live(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder(fn (Get $get) => $get('course_id') ? Course::find($get('course_id'))->name : null )
                    ->label('Nome corso'),
                Forms\Components\Select::make('course_type_id')
                    ->required()
                    ->label('Tipo di corso')
                    ->options(CourseType::all()->pluck('name', 'id')),
                Forms\Components\Select::make('tutor_id')
                    //->required()
                    ->label('Tutor')
                    //->placeholder('Crea prima un Tutor')
                    ->options(Tutor::where('branch_id', '=', $currentBranch->id)->pluck('name', 'id')),
                Forms\Components\FileUpload::make('banner')
                    ->label('Locandina'),
                Forms\Components\TextInput::make('actual_price')
                    ->required()
                    ->numeric()
                    //->reactive()
                    ->placeholder(fn (Get $get) => $get('course_id') ? Course::find($get('course_id'))->list_price : 0 )
                    //->default( function (callable $get){$get('course_id') ? Course::find($get('course_id'))->list_price : 0;})
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
            ->striped()
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')->label('Codice Evento')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('branch.name')->label('Sede')->searchable(isIndividual: true)->visible(fn (): bool => auth()->user()->role_id == CFP),
                Tables\Columns\TextColumn::make('course.name')->label('Argomento')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('name')->label('Nome Corso')->sortable()->searchable(isIndividual: true),
                Tables\Columns\ImageColumn::make('banner') // TODO [EA:20231205]: Remember to use php artisan storage:link
                ->getStateUsing(function (FormationEvent $record): string {
                    return $record->banner??'';
                })->label('Locandina')
                    ->extraImgAttributes([
                        'height' => '50px'
                    ])
                //->extraImgAttributes('')
                //->height('5')
                ,
                Tables\Columns\TextColumn::make('course.list_price')->label('Prezzo')->sortable(),
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
