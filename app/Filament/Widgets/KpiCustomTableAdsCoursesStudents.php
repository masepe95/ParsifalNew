<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\Widget;

class KpiCustomTableAdsCoursesStudents extends Widget
{
    protected static string $view = 'filament.widgets.kpi-custom-ads-courses-students';

    use InteractsWithPageFilters;

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'half';

}
