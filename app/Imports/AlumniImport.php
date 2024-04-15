<?php

namespace App\Imports;

use App\Models\Alumnus;
use App\Models\Branch;
use App\Models\CFP;
use App\Models\CamelotCandidate;
use Carbon\Carbon;
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
        if ($row['email']) {
            //
            $branch = Branch::where('user_id', '=', auth()->id())->first();
            $cfp = CFP::where('id','=',$branch->cfp_id)->first();
            $alumnus = new Alumnus([
                'branch_id' => $branch->id,
                'name' => $row['nome'] ?? '',
                'surname' => $row['cognome'] ?? '',
                'dob' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_di_nascita'] ?? null),
                'address' => $row['indirizzo_completo'] ?? '',
                'email' => $row['email'] ?? '',
                'phone' => $row['telefono'] ?? '',
                'course_name' => $row['nome_corso'] ?? $row['nome_del_corso_di_formazione'] ?? '',
                'start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_inizio'] ?? $row['data_di_inizio'] ?? null),
                'end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['data_fine'] ?? $row['data_di_fine'] ?? null),
                'score' => $row['esito'] ?? '',
                'tutor_name' => $row['nome_tutor'] ?? '',
            ]);

            // Prepare pre-registration for Camelot Candidate
            $was_camelot_candidate = CamelotCandidate::where('email', $alumnus->email)->first();
            if (!isset($was_camelot_candidate)) {
                $password = "Invito@Camelot";
                $camelot_candidate_data = [
                    'name' => $alumnus->name . ' ' . $alumnus->surname,
                    'email' => $alumnus->email,
                    'email_verified_at' => Carbon::now(),
                    'lead_source' => $cfp->name . '|import_alumni|' . $branch->id . '|', // lead_source = nome_cfp|import_alumni|id_branch
                    'password' => \Illuminate\Support\Facades\Hash::make($password),
                ];
                $camelot_candidate = new CamelotCandidate($camelot_candidate_data);
                $camelot_candidate->save();

                //Invia mail di invito
                $mailData = [
                    'candidate_id' => $camelot_candidate->id,
                    'branch_id' => $branch->id,
                    'name' => $camelot_candidate->name,
                    'email' => $camelot_candidate->email,
                    'password' => $password
                ];

                $alumnus['camelot_candidate_id'] = $camelot_candidate->id;

                \Mail::to($camelot_candidate->email)->bcc(config('constants.dev_mail'))->send(new \App\Mail\CamelotInvite($mailData));
                \Log::info(print_r('Import successful, Camelot pre-registration mail sent: ' . print_r($alumnus, true), true));
            }

            return $alumnus;
        }
            else{
                return null;
        }

    }

}
