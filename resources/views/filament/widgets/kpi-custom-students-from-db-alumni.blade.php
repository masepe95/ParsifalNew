@php

    use Illuminate\Support\Facades\DB;
    use App\Models\Branch;
    use App\Models\Student;
    use App\Models\FormationEvent;
    use App\Models\CFP;
    use Carbon\Carbon;

    xdebug_break();

    $startDate = filled($this->filters['startDate'] ?? null) ?
        Carbon::parse($this->filters['startDate']) :
        '2023-01-01';

    $endDate = filled($this->filters['endDate'] ?? null) ?
        Carbon::parse($this->filters['endDate']) :
        now();

    $branch_id = $this->filters['geographic'] ?? 0;

    /*
     *  Questa KPI deve mostrare il numero di Candidati Camelot inviati dal DB alunni della specifica sede,
     *  rapportato al numero totale di Candidati Camelot, sul periodo
     */

    if (auth()->user()->role_id == BRANCH) {
        $branch = Branch::where('user_id',auth()->id())->first();
        $branch_id = $branch->id;
    }

    if (auth()->user()->role_id == CFP) {
        $cfp = CFP::where('user_id',auth()->id())->first();
        $formation_events = $cfp->formationEvents;
        //$total = \App\Models\CamelotCandidate::all()->whereBetween('created_at',[$startDate,$endDate]);
        //$total = Student::whereIn( 'formation_event_id', ( $formation_events->pluck('id') ) )->whereBetween('created_at',[$startDate,$endDate])->get();
        //dd($total);
        $branches = $cfp->branches;

        if($branch_id != 0){ // Singola branch, con id definito
            $branch = Branch::find($branch_id);
            $results = \App\Models\CamelotCandidate::where('lead_source','=','cfp|import_alumni|'. $branch->id)->whereBetween('created_at',[$startDate,$endDate])->pluck('id');
            $activated = \App\Models\CamelotCandidateProfile::whereIn('user_id',$results)->whereBetween('created_at',[$startDate,$endDate]);
            $total = $branch->alumni->whereBetween('created_at',[$startDate,$endDate]);
        }
        else{ // branch->id == 0, devo gestirle tutte
            $branches_leads = array();
            foreach($branches as $branch){
                $branch_lead = 'cfp|import_alumni|'.$branch->id;
                $branches_leads[] = $branch_lead;
            }
            $results = \App\Models\CamelotCandidate::whereIn('lead_source',$branches_leads)->whereBetween('created_at',[$startDate,$endDate])->pluck('id');
            $activated = \App\Models\CamelotCandidateProfile::whereIn('user_id',$results)->whereBetween('created_at',[$startDate,$endDate]);
            $total = $cfp->alumni->whereBetween('created_at',[$startDate,$endDate]);
        }
    }
    else{// Altrimenti, mostra solo gi Alunni associati direttamente alla Branch corrente
        //$results = \App\Models\Student::query()->where('branch_id', Branch::where('user_id', auth()->id())->first()->id );
         $branch = Branch::where('user_id',auth()->id())->first();
//         dd($branch);
         $results = \App\Models\CamelotCandidate::where('lead_source','=','cfp|import_alumni|'. $branch->id)->whereBetween('created_at',[$startDate,$endDate])->pluck('id');
         $activated = \App\Models\CamelotCandidateProfile::whereIn('user_id',$results)->whereBetween('created_at',[$startDate,$endDate]);
         $total = $branch->alumni->whereBetween('created_at',[$startDate,$endDate]);
//         dd($results);
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
        {{----}}
        <h1>Candidati iscritti in Camelot dal DB Alunni per la sede {{ Branch::find($branch_id)->name ?? '' }}:</h1>
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
                <td style="text-align: center">{{ $activated->count() }}</td>
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
