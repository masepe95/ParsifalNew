<?php

namespace App\Filament\Widgets;

use App\Models\CamelotCandidateSearch;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use mysql_xdevapi\ColumnResult;

class KpiTable extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'half';

    public function table(Table $table): Table
    {
        $startDate = filled($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = filled($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

        $branch_id = $this->filters['geographic'] ?? 0;

        return $table
            ->query(
                //(fn (Builder $query) => $query->where('created_at', '', '')

            // TODO [EA20231206]: si deve tirar fuori una *query*
            // con questo funziona ma non è giusto:
                CamelotCandidateSearch::query()
                    ->join('parsifal_db_stage.branches as pb','pb.id', '=', 'pb.id')
                    ->limit(5)

            // Questo è il SQL giusto, ma non funziona (errore Filament\Tables\Table::query(): Argument #1 ($query) must be of type Illuminate\Database\Eloquent\Builder|Closure|null, Illuminate\Database\Eloquent\Collection given, called in C:\inetpub\wwwroot\parsifal_webapp_stage\app\Filament\Widgets\KpiTable.php on line 40 {"userId":2,"exception":"[object] (TypeError(code: 0): Filament\\Tables\\Table::query(): Argument #1 ($query) must be of type Illuminate\\Database\\Eloquent\\Builder|Closure|null, Illuminate\\Database\\Eloquent\\Collection given, called in C:\\inetpub\\wwwroot\\parsifal_webapp_stage\\app\\Filament\\Widgets\\KpiTable.php on line 40 at C:\\inetpub\\wwwroot\\parsifal_webapp_stage\\vendor\\filament\\tables\\src\\Table\\Concerns\\HasQuery.php:28):
//            DB::raw("
//                select
//                    #DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km'),
//                    cdj.task_id,
//                    ct.name,
//                    count(cdj.task_id) as count
//                from camelot_db.dream_jobs as cdj
//                inner join camelot_db.tasks as ct on cdj.task_id = ct.id
//                inner join parsifal_db_stage.branches as pb
//                where DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 50
//                and pb.id = $branch_id # ===> Branch Id
//                and cdj.created_at between $startDate and $endDate # ===> Time range
//                group by cdj.task_id
//                order by cnt desc
//                limit 5
//            ")
        )
        ->columns([
            // ...
            Tables\Columns\TextColumn::make('index')->label('Posizione')->rowIndex(),
            Tables\Columns\TextColumn::make('id')->label('Id'),
            Tables\Columns\TextColumn::make('name')->label('Mansione'),
            //Tables\Columns\TextColumn::make('count')->label('Occorrenze'),
        ]);
    }
}
