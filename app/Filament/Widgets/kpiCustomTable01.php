<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class kpiCustomTable01 extends Widget
{
    protected static string $view = 'filament.widgets.kpi-custom-table01';

    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'half';

}
