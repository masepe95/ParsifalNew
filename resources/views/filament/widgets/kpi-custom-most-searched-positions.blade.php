@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;

    $startDate = filled($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        null;

    $endDate = filled($this->filters['endDate'] ?? null) ?
        Carbon::parse($this->filters['endDate']) :
        now();

    $branch_id = $this->filters['geographic'] ?? 0;

//    $results = DB::select("select * from branches where id=$branch_id limit 4");

    $results = DB::select("
                select
                    #DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km'),
                    ccrc.task_id,
                    ct.name as name,
                    count(ccrc.task_id) as count
                from camelot_db_stage.company_research_candidates as ccrc
                inner join parsifal_db_stage.branches as pb
                inner join camelot_db_stage.tasks as ct on ccrc.task_id = ct.id
                where 1=1
                and DISTANCE(ccrc.gps_lat,ccrc.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 250
                and pb.id = $branch_id # ===> Branch Id
                and ccrc.created_at between '$startDate' and '$endDate' # ===> Time range
                group by ccrc.task_id
                order by count desc
                limit 5
            ")

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <!--h1 style="text-align: center; font-weight: 900; font-size: 35px">Sedi:</h1-->
        <h1>Mansioni più ricercate dalle Aziende nella zona della sede {{Branch::find($branch_id)->name}}:</h1>
        <br/>
        <table class="table">
            <thead>
            <tr>
                <th>Mansione</th>
                <th>Occorrenze</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td style="text-align: left">{{ $result->name }}</td>
                    <td style="text-align: right">{{ $result->count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-filament::section>
</x-filament-widgets::widget>
