<?php

namespace Database\Seeders;

use App\Models\CFPAccreditationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CfpAccreditationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CFPAccreditationType::create([
            'id'=>1,
            'name' => 'Si',
        ]);
        CFPAccreditationType::create([
            'id'=>2,
            'name' => 'No',
        ]);
    }
}
