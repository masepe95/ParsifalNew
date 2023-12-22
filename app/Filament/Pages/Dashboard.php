<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Page;
use App\Models\CFP;
use App\Models\Branch;

class Dashboard extends BaseDashboard
{
    use \Filament\Pages\Dashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        if(auth()->user()->role_id == CFP) {
            return $form
                ->schema([
                    Section::make()
                        ->schema([
                            //Select::make('businessCustomersOnly')
                            //    ->boolean(),
                            Select::make('geographic')
                                ->label('Sede (area geografica)')
                                ->options(Branch::where('cfp_id', CFP::where('user_id', auth()->id())->first()->id)->pluck('name', 'id'))
                            ,
                            DatePicker::make('startDate')
                                ->label('Periodo - dal:')
                                ->maxDate(fn(Get $get) => $get('endDate') ?: now())
                            ,
                            DatePicker::make('endDate')
                                ->label('Periodo - al:')
                                ->minDate(fn(Get $get) => $get('startDate') ?: now())
                                ->maxDate(now())
                            ,
                        ])
                        ->columns(3),
                ]);
        }
        else{
            return $form
                ->schema([
                    Section::make()
                        ->schema([
                            DatePicker::make('startDate')
                                ->label('Periodo - dal:')
                                ->maxDate(fn(Get $get) => $get('endDate') ?: now())
                            ,
                            DatePicker::make('endDate')
                                ->label('Periodo - al:')
                                ->minDate(fn(Get $get) => $get('startDate') ?: now())
                                ->maxDate(now())
                            ,
                        ])
                        ->columns(3),
                ]);
        }
    }
}
