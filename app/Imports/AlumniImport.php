<?php

namespace App\Imports;

use App\Models\Alumnus;
use App\Models\Branch;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        // https://github.com/SpartnerNL/Laravel-Excel/issues/1832#issuecomment-520237992
        // Deals with date formatted as Date or Text in Excel
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param Model $model
    */
    public function model(array $row)
    {
        //
        $branch = Branch::where('user_id', '=', auth()->id())->first();
        $alumnus =  new Alumnus([
            'branch_id'     => $branch->id,
            'name'     => $row['nome']??'',
            'surname'    => $row['cognome']??'',
            'dob'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_di_nascita']??null),
            'address'    => $row['indirizzo_completo']??'',
            'email'    => $row['email']??'',
            'phone'    => $row['telefono']??'',
            'course_name'    => $row['nome_corso']??$row['nome_del_corso_di_formazione']??'',
            'start_date'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_inizio']??$row['data_di_inizio']??null),
            'end_date'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_fine']??$row['data_di_fine']??null),
            'score'    => $row['esito']??'',
            'tutor_name'    => $row['nome_tutor']??'',
        ]);
        return $alumnus;
    }
}
