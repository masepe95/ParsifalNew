<?php

namespace Database\Seeders;

use App\Models\CFPFormationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CfpFormationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CFPFormationType::create([
            'id'=>1,
            'name' => 'Iniziale',
        ]);
        CFPFormationType::create([
            'id'=>2,
            'name' => 'Continua',
        ]);
    }
}
