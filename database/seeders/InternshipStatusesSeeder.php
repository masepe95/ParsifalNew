<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InternshipStatus;

class InternshipStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //·	Non risponde
        //·	Non interessata
        //·	Interessata in attesa di documentazione
        //·	Documentazione ricevuta
        //·	Attesa documentazione
        //·	Tirocinio avviato
        //·	Tirocinio non avviato
        InternshipStatus::create([
            'id'=>1,
            'name' => 'Non risponde',
        ]);
        InternshipStatus::create([
            'id'=>2,
            'name' => 'Non interessata',
        ]);
        InternshipStatus::create([
            'id'=>3,
            'name' => 'Interessata in attesa di documentazione',
        ]);
        InternshipStatus::create([
            'id'=>4,
            'name' => 'Documentazione ricevuta',
        ]);
        InternshipStatus::create([
            'id'=>5,
            'name' => 'Attesa ritorno documentazione',
        ]);
        InternshipStatus::create([
            'id'=>6,
            'name' => 'Tirocinio avviato',
        ]);
        InternshipStatus::create([
            'id'=>7,
            'name' => 'Tirocinio non avviato',
        ]);
    }
}
