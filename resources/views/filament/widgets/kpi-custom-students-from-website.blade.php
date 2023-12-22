@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;
    use App\Models\Student;
    use App\Models\FormationEvent;
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
        $cfp = CFP::where('user_id',auth()->id())->first();
        $results = \App\Models\CamelotCandidate::where('lead_source','like', "%{$cfp->name}%")->whereBetween('created_at',[$startDate,$endDate]);
    }
    else{// Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente        $cfp = CFP::where('user_id',auth()->id())->first();
        $branch = Branch::where('user_id',auth()->id())->first();
//         dd($branch);
        $cfp = $branch->cfp;
        $results = \App\Models\CamelotCandidate::where('lead_source','like', "%{$cfp->name}%")->whereBetween('created_at',[$startDate,$endDate]);
//         dd($results);
    }
    $total = \App\Models\CamelotCandidate::all()->whereBetween('created_at',[$startDate,$endDate]);


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
        {{--        <h1>Candidati segnalati in Camelot dal Web site per la sede {{ Branch::find($branch_id)->name ?? '' }}:</h1>--}}
        <h1>Candidati segnalati in Camelot dal Web site del CFP :</h1>
        <table class="modern-table">
            <thead>
            <tr>
                <th>Occorrenze</th>
                <th style="text-align: right">Percentuale (su {{ $total->count() }} tot.)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center">{{ $results->count() }}</td>
                @if($total->count() != 0)
                    <td style="text-align: right">{{ number_format($results->count() / $total->count() * 100,2) }}%</td>
                @else
                    <td style="text-align: right">n.d.</td>
                @endif
            </tr>
            </tbody>
        </table>
        {{----}}
    </x-filament::section>
</x-filament-widgets::widget>
