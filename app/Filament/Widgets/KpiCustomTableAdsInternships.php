<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class KpiCustomTableAdsInternships extends Widget
{
    protected static string $view = 'filament.widgets.kpi-custom-ads-internships';

    use InteractsWithPageFilters;

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'half';

}
