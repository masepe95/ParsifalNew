<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class KpiCustomTableCamelotCandidatesFromWebSite extends Widget
{
    protected static string $view = 'filament.widgets.kpi-custom-students-from-website';

    use InteractsWithPageFilters;

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'half';

}
