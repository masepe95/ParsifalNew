<?php

namespace Database\Seeders;

use App\Models\CFPCourseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CfpCourseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CFPCourseType::create([
            'id'=>1,
            'name' => 'Finanziati',
        ]);
        CFPCourseType::create([
            'id'=>2,
            'name' => 'A Catalogo',
        ]);
    }
}
