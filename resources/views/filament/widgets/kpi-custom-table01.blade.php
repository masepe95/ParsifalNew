@php
    use Illuminate\Support\Facades\DB;

        $startDate = filled($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = filled($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now();

        $branch_id = $this->filters['geographic'] ?? 0;
        //dd($branch_id);

    $results = DB::select("select * from branches where id=$branch_id limit 4");
@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <h1 style="text-align: center; font-weight: 900; font-size: 35px">Sedi:</h1>
        <table>
            <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <td style="text-align: center">{{ $result->id }}</td>
                    <td style="text-align: center">{{ $result->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-filament::section>
</x-filament-widgets::widget>
