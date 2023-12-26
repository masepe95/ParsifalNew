<?php

namespace App\Exports;

use App\Models\Internship;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IntershipsExports implements FromCollection, WithHeadings, WithMapping
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
        return Internship::with(['branch'])
            ->whereIn('id', $this->ids)
            ->get();
    }
    public function headings(): array
    {
        // Intestazioni per il foglio Excel
        return [
            'ID',
            'BRANCH',
            'CAMELOT COMPANY ID',
            'CAMELOT MATCH ID',
            'NOME',
            'E-MAIL',
            'TELEFONO',
            'DATA ISCRIZIONE PARSIFAL',
            'CREATO IL',
            'MODIFICATO IL'
        ];
    }
    public function map($intership): array
    {
        // Mappa i dati dell'utente e delle sue relazioni in una riga di Excel
        return [
            $intership->id,
            $intership->branch->name,
            $intership->camelot_company_id,
            $intership->camelot_company_match_id,
            $intership->name,
            $intership->email,
            $intership->phone,
            $intership->parsifal_enrolled_at,
            $intership->created_at,
            $intership->updated_at
        ];
    }
}
