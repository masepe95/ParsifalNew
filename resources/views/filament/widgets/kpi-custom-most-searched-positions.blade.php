@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;
    use Carbon\Carbon;

    //xdebug_break();

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

    if( empty($branch_id) || $branch_id == 0 ){
        $results = null;
        $total_weighted_positions = null;
        $total_positions = null;
    }
    else{
        $results = DB::select("
            select
                #DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km'),
                ccrc.task_id,
                ct.name as name,
                count(ccrc.task_id) as count
            from " . config('database.connections.mysql_camelot.database') . ".company_research_candidates as ccrc
            inner join branches as pb
            inner join " . config('database.connections.mysql_camelot.database') . ".tasks as ct on ccrc.task_id = ct.id
            where 1=1
            and DISTANCE(ccrc.gps_lat,ccrc.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 250
            and pb.id = $branch_id # ===> Branch Id
            and ccrc.created_at between '$startDate' and '$endDate' # ===> Time range
            group by ccrc.task_id
            order by count desc
            limit 5
        ");

        $total_weighted_positions = DB::select("
            select count(*) as count
            from " . config('database.connections.mysql_camelot.database') . ".company_research_candidates as ccrc
            inner join branches as pb
            where DISTANCE(ccrc.gps_lat,ccrc.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 250
            and pb.id = $branch_id # ===> Branch Id
            and ccrc.created_at between '$startDate' and '$endDate' # ===> Time range
        ");

        $total_positions = DB::select("
            select count(*) as count
            from " . config('database.connections.mysql_camelot.database') . ".company_research_candidates as ccrc
        ");
    }

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <!--h1 style="text-align: center; font-weight: 900; font-size: 35px">Sedi:</h1-->
        <link rel="stylesheet" href="css/modern-table.css">

        <h1>Mansioni più ricercate dalle Aziende @if($branch_id)  nella zona della sede {{Branch::find($branch_id)->name ?? ''}}:@endif</h1>
        <table class="modern-table">
            <thead>
            <tr>
                <th>Pos.</th>
                <th>Mansione</th>
                <th>Occorrenze<br/>(su {{ $total_weighted_positions[0]->count ?? ''}} tot.)</th>
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
                        @if($total_weighted_positions[0]->count != 0)
                            <td style="text-align: right">{{ number_format($result->count / $total_weighted_positions[0]->count * 100,2) ?? ''}}%</td>
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
