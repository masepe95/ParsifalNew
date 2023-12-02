<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TutorType;

class TutorTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //•	Docente
        //•	Tutor Allievi
        //•	Operatore
        //
        TutorType::create([
            'id'=>1,
            'name' => 'Docente',
        ]);
        TutorType::create([
            'id'=>2,
            'name' => 'Tutor Allievi',
        ]);
        TutorType::create([
            'id'=>3,
            'name' => 'Operatore',
        ]);
    }
}
