<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CFPAudienceType;

class CfpAudienceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CFPAudienceType::create([
            'id'=>1,
            'name' => 'Disoccupati',
        ]);
        CFPAudienceType::create([
            'id'=>2,
            'name' => 'Occupati',
        ]);
    }
}
