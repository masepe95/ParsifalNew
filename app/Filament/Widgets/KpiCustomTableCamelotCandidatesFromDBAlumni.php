<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class KpiCustomTableCamelotCandidatesFromDBAlumni extends Widget
{
    protected static string $view = 'filament.widgets.kpi-custom-students-from-db-alumni';

    use InteractsWithPageFilters;

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'half';

}
