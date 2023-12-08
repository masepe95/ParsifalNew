<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class KpiCustomTableMostSearchedPositions extends Widget
{
    protected static string $view = 'filament.widgets.kpi-custom-most-searched-positions';

    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'half';

}
