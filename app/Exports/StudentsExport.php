<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    private $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::with(['origin', 'formationEvent'])
            ->whereIn('id', $this->ids)
            ->get();
    }
    public function headings(): array
    {
        // Intestazioni per il foglio Excel
        return [
            'ID',
            'ID EVENTO FORMAZIONE',
            'ID CANDIDATO CAMELOT',
            'E-MAIL',
            'NOME',
            'TELEFONO',
            'DATA ISCRIZIONE PARSIFAL',
            'MAIL MANDATA IL',
            'ID ORIGINE',
            'CREATO IL',
            'MODIFICATO IL'
        ];
    }
    public function map($student): array
    {
        // Mappa i dati dell'utente e delle sue relazioni in una riga di Excel
        return [
            $student->id,
            $student->formationEvent->course->name,
            $student->camelot_candidate_id,
            $student->email,
            $student->name,
            $student->phone,
            $student->email,
            $student->parsifal_enrolled_at,
            $student->camelot_preregistration_email_sent_at,
            $student->origin->name,
            $student->created_at,
            $student->updated_at
        ];
    }
}
