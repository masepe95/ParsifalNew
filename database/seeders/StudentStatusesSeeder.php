<?php

namespace Database\Seeders;

use App\Models\StudentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //·	Non risponde
        //·	Non Interessato
        //·	Interessato in attesa di documentazione
        //·	Iscritto
        //·	Non iscritto
        StudentStatus::create([
            'id'=>0,
            'name' => 'Da contattare',
        ]);
        StudentStatus::create([
            'id'=>1,
            'name' => 'Non risponde',
        ]);
        StudentStatus::create([
            'id'=>2,
            'name' => 'Non interessato',
        ]);
        StudentStatus::create([
            'id'=>3,
            'name' => 'Interessato in attesa di documentazione',
        ]);
        StudentStatus::create([
            'id'=>4,
            'name' => 'Non iscritto',
        ]);
        StudentStatus::create([
            'id'=>5,
            'name' => 'Iscritto',
        ]);
    }
}
