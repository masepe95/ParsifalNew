<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Catalogo Corsi';
    protected static ?int $navigationSort = 5;

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Corso');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Corsi');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Argomento/Nome del Corso'),
                Forms\Components\Select::make('course_type_id')
                    ->required()
                    ->label('Tipo di corso')
                    ->options(CourseType::all()->pluck('name', 'id')),
                Forms\Components\Select::make('task_id')
                    ->required()
                    ->label('Mansione a cui associarlo')
                    ->searchable()
                    ->options(Task::where('active', 1)->pluck('name', 'id')),
                Forms\Components\TextInput::make('code')
                    ->label('Codice (facoltativo)'),
                Forms\Components\TextArea::make('description')
                    ->required()
                    ->label('Descrizione'),
                Forms\Components\FileUpload::make('banner')
                    ->label('Locandina'),
                Forms\Components\TextInput::make('list_price')
                    ->required()
                    ->numeric()
                    ->label('Costo di listino'),
                Forms\Components\TextInput::make('duration_hours')
                    ->required()
                    ->numeric()
                    ->label('Durata (in ore)'),
                Forms\Components\DatePicker::make('available_from')
                    ->label('Disponibile dal'),
                Forms\Components\DatePicker::make('available_until')
                    ->label('Disponibile al'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('code')->label('Codice')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('name')->label('Argomento')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('description')->label('Descrizione')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('task_id')->label('Task')->sortable()->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('courseType.name')->label('Modalità')->sortable()->searchable(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
