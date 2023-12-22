@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;
    use Carbon\Carbon;

    xdebug_break();

    $startDate = filled($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        '2023-01-01';

    $endDate = filled($this->filters['endDate'] ?? null) ?
        Carbon::parse($this->filters['endDate']) :
        now();

    $branch_id = $this->filters['geographic'] ?? 0;

    if (auth()->user()->role_id == BRANCH) {
        $branch = Branch::where('user_id',auth()->id())->first();
        $branch_id = $branch->id;
    }

    if( !isset($branch_id) && $branch_id == 0 ){
        $results = null;
        $total_weighted_dream_jobs = null;
        $total_dream_jobs = null;
    }
    else{
        $results = DB::select("
                select
                    #DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km'),
                    cdj.task_id,
                    ct.name as name,
                    count(cdj.task_id) as count
                from camelot_db.dream_jobs as cdj
                inner join " . config('database.connections.mysql_camelot.database') . ".tasks as ct on cdj.task_id = ct.id
                inner join branches as pb
                where DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 50
                and pb.id = $branch_id # ===> Branch Id
                and cdj.created_at between '$startDate' and '$endDate' # ===> Time range
                group by cdj.task_id
                order by count desc
                limit 5
            ");

        $total_weighted_dream_jobs = DB::select("
                select count(*) as count
                from camelot_db.dream_jobs as cdj
                inner join branches as pb
                where DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 50
                and pb.id = $branch_id # ===> Branch Id
                and cdj.created_at between '$startDate' and '$endDate' # ===> Time range
            ");

        $total_dream_jobs = DB::select("
            select count(*) as count
            from " . config('database.connections.mysql_camelot.database') . ".dream_jobs
        ");
    }


@endphp
<x-filament-widgets::widget>
    <style>
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* Ensures the inner elements respect the border radius */
        }

        .modern-table thead tr {
            background-color: #009879;
            color: white;
            text-align: left;
        }

        .modern-table th,
        .modern-table td {
            padding: 12px 15px;
        }

        .modern-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .modern-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .modern-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .modern-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
    <x-filament::section>
        <h1>Mansioni più ricercate dai Candidati @if($branch_id) nella zona della sede {{ Branch::find($branch_id)->name  ?? ''}}: @endif</h1>
        <table class="modern-table">
            <thead>
            <tr>
                <th>Pos.</th>
                <th>Mansione</th>
                <th>Occorrenze<br/>(su {{ $total_weighted_dream_jobs[0]->count ?? ''}} tot.)</th>
                <th>Percentuale</th>
            </tr>
            </thead>
            <tbody>
            @php $rownum = 1; @endphp
            @if($results)
            @foreach ($results as $result)
                    <tr>
                        <td style="text-align: left">{{ $rownum }}</td>
                        <td style="text-align: left">{{ $result->name ?? '' }}</td>
                        <td style="text-align: center">{{ $result->count ?? '' }}</td>
                        @if($total_weighted_dream_jobs[0]->count != 0)
                            <td style="text-align: right">{{ number_format($result->count / $total_weighted_dream_jobs[0]->count * 100,2) ?? '' }}%</td>
                        @else
                            <td style="text-align: right">n.d.</td>
                        @endif
                    </tr>
                    @php $rownum++; @endphp
                @endforeach
            @else
                <tr><td colspan="4" style="text-align: center">Seleziona una sede...</td></tr>
            @endif
            </tbody>
        </table>
    </x-filament::section>
</x-filament-widgets::widget>
