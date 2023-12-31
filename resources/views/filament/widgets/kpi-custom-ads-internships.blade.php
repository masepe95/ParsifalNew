@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;
    use App\Models\Internship;
    use App\Models\CFP;
    use Carbon\Carbon;

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

    if (auth()->user()->role_id == CFP) {
        $total = Internship::query()->whereHas('branch', function ($query) {
            $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
        })->get();
        if($branch_id != 0){
            $results = Internship::query()->whereHas('branch', function ($query) {
                $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
            })
            ->where('branch_id',$branch_id)
            ->whereBetween('created_at',[$startDate,$endDate])
            ->get();
        }
        else{
            $results = $total;
        }
    }
    else{// Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente
        $results = Internship::query()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id )->whereBetween('created_at',[$startDate,$endDate])->get();
        $total = Internship::query()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id )->get();
    }

    /*
    if (auth()->user()->role_id == CFP) {
        $results = Internship::query()->whereHas('branch', function ($query) {
            $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
        })
        ->where('branch_id',$branch_id)
        ->whereBetween('created_at',[$startDate,$endDate])
        ->get();
        $total = Internship::query()->whereHas('branch', function ($query) {
            $query->where('cfp_id', CFP::where('user_id', auth()->id())->first()->id);
        })->get();
    }
    else{// Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente
        $results = Internship::query()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id )->whereBetween('created_at',[$startDate,$endDate])->get();
        $total = Internship::query()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id )->get();
    }
    */

@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        <link rel="stylesheet" href="css/modern-table.css">

        <h1>ADS Tirocini/Stage per la sede {{ Branch::find($branch_id)->name ?? '' }}:</h1>
        <table class="modern-table">
            <thead>
            <tr>
                <th>Segnalati</th>
                <th>Attivati</th>
                <th style="text-align: right">Percentuale (su {{ $total->count() }} tot.)</th>
                {{--
                <th>Percentuale</th>
                --}}
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center">{{ $results->count() }}</td>
                    <td style="text-align: center">{{ $results->where('internship_status_id','=',STARTED)->count() }}</td>
                    {{--
                    <td style="text-align: center">{{ $total->count() }}</td>
                    --}}
                    @if($total->count() != 0)
                        <td style="text-align: right">{{ number_format( $results->where('internship_status_id','=',STARTED)->count() / $total->count() * 100,2) }}%</td>
                    @else
                        <td style="text-align: right">n.d.</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </x-filament::section>
</x-filament-widgets::widget>
