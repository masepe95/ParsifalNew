<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CFPResource\Pages;
use App\Filament\Resources\CFPResource\RelationManagers;
use App\Models\CFP;
use App\Models\CFPAccreditationType;
use App\Models\CFPAudienceType;
use App\Models\CFPCourseType;
use App\Models\CFPFormationType;
use App\Models\CFPType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CFPResource extends Resource
{
    protected static ?string $model = CFP::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Profilo Centro di Formazione';

    // Customize Model's Labels as per https://github.com/filamentphp/filament/discussions/5275#discussioncomment-4444250
    public static function getModelLabel(): string
    {
        return __('Centro Formativo');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Centri Formativi');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nome Società'),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('vat_number')
                    ->required()
                    ->maxLength(16)
                    ->label('Partita IVA'),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->label('Indirizzo'),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->label('Località'),
                Forms\Components\TextInput::make('district')
                    ->required()
                    ->maxLength(2)
                    ->label('Provincia'),
                Forms\Components\TextInput::make('postal_code')
                    ->required()
                    ->maxLength(5)
                    ->label('C.A.P.'),
                Forms\Components\TextInput::make('manager_name')
                    ->required()
                    ->label('Nome Referente'),
                Forms\Components\TextInput::make('manager_surname')
                    ->required()
                    ->label('Cognome Referente'),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->label('Telefono'),
                Forms\Components\TextInput::make('social_fb')
                    ->label('Pagina Facebook'),
                Forms\Components\TextInput::make('social_ig')
                    ->label('Pagina Instagram'),
                Forms\Components\TextInput::make('social_x')
                    ->label('Pagina X (Twitter)'),
                Forms\Components\TextInput::make('social_li')
                    ->label('Pagina LinkedIn'),
                Forms\Components\Textarea::make('description')
                    ->label('Breve Descrizione'),
                Forms\Components\FileUpload::make('logo')
                    ->label('Logo Società'),
                Forms\Components\Checkbox::make('internship_enabled')
                    ->label('Erogazione Tirocini'),
                Forms\Components\Checkbox::make('stage_enabled')
                    ->label('Erogazione Stage'),
                Forms\Components\Select::make('cfp_type_id')
                    ->required()
                    ->label('Tipo di Centro')
                    ->options(CFPType::all()->pluck('name', 'id')),
                Forms\Components\Select::make('cfp_accreditation_type_id')
                    ->required()
                    ->label('Accreditamento')
                    ->options(CFPAccreditationType::all()->pluck('name', 'id')),
                Forms\Components\checkBoxList::make('cfp_formation_types')
                    //->required()
                    ->label('Tipi di Formazione')
                    ->relationship('cfpFormationTypes','name'),
                Forms\Components\checkBoxList::make('cfp_course_types')
                    //->required()
                    ->label('Tipo di Corsi')
                    ->relationship('cfpCourseTypes','name'),
                Forms\Components\checkBoxList::make('cfp_audience_types')
                    //->required()
                    ->label('Tipo di Destinatari')
                    ->relationship('cfpAudienceTypes','name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Ragione sociale'),
                Tables\Columns\TextColumn::make('address')
                    ->formatStateUsing(function ($state, CFP $cfp) {
                        return $cfp->address . ', ' . $cfp->city;})
                    ->label('Indirizzo sede legale'),
                Tables\Columns\TextColumn::make('manager_surname')
                    ->formatStateUsing(function ($state, CFP $cfp) {
                        return $cfp->manager_name . ' ' . $cfp->manager_surname;})
                    ->label('Referente'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\IconColumn::make('stage_enabled')
                    ->boolean()
                    ->label('Erogazione Stages'),
                Tables\Columns\IconColumn::make('internship_enabled')
                    ->boolean()
                    ->label('Erogazione Tirocini'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
//            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
//            ])
        ;
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
            'index' => Pages\ListCFPS::route('/'),
            'create' => Pages\CreateCFP::route('/create'),
            'edit' => Pages\EditCFP::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
