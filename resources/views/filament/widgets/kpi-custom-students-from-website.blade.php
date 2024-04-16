@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;
    use App\Models\Student;
    use App\Models\FormationEvent;
    use App\Models\CFP;
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

    if ( auth()->user()->role_id == CFP || auth()->user()->role_id == ISADMIN ) {
        $cfp = CFP::where('user_id',auth()->id())->first();
        $results = \App\Models\CamelotCandidate::where('lead_source','like', "%$cfp->name%")->whereNot('lead_source','like', "%|import_alumni|%")->whereBetween('created_at',[$startDate,$endDate])->pluck('id');
        $activated = \App\Models\CamelotCandidateProfile::whereIn('user_id',$results)->whereBetween('created_at',[$startDate,$endDate]);
    }
    else{// Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente        $cfp = CFP::where('user_id',auth()->id())->first();
        $branch = Branch::where('user_id',auth()->id())->first();
//         dd($branch);
        $cfp = $branch->cfp;
        $results = \App\Models\CamelotCandidate::where('lead_source','like', "%$cfp->name%")->whereNot('lead_source','like', "%|import_alumni|%")->whereBetween('created_at',[$startDate,$endDate])->pluck('id');
//         dd($results);
        $activated = \App\Models\CamelotCandidateProfile::whereIn('user_id',$results)->whereBetween('created_at',[$startDate,$endDate]);
    }
    $total = \App\Models\CamelotCandidate::all()->whereBetween('created_at',[$startDate,$endDate]);


@endphp
<x-filament-widgets::widget>
    <x-filament::section>
        {{--        <h1>Candidati segnalati in Camelot dal Web site per la sede {{ Branch::find($branch_id)->name ?? '' }}:</h1>--}}
        <link rel="stylesheet" href="css/modern-table.css">

        <h1>Candidati segnalati in Camelot dal Web site del CFP :</h1>
        <table class="modern-table">
            <thead>
            <tr>
                <th>Totale segnalazioni</th>
                <th>Profili attivati</th>
                <th style="text-align: right">Percentuale (su {{ $total->count() }} tot.)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="text-align: center">{{ $results->count() }}</td>
                <td style="text-align: center">{{ $results->whereNotNull('email_verified_at')->count() }}</td>
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
