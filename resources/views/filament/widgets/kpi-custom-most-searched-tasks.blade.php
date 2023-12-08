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
                    cdj.task_id,
                    ct.name as name,
                    count(cdj.task_id) as count
                from camelot_db.dream_jobs as cdj
                inner join camelot_db.tasks as ct on cdj.task_id = ct.id
                inner join parsifal_db_stage.branches as pb
                where DISTANCE(cdj.gps_lat,cdj.gps_lon,pb.gps_lat,pb.gps_lon,'km') < 50
                and pb.id = $branch_id # ===> Branch Id
                and cdj.created_at between '$startDate' and '$endDate' # ===> Time range
                group by cdj.task_id
                order by count desc
                limit 5
            ")

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <!--h1 style="text-align: center; font-weight: 900; font-size: 35px">Sedi:</h1-->
        <h1>Mansioni più ricercate dai Candidati nella zona della sede {{Branch::find($branch_id)->name}}:</h1>
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
