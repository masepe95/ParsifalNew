<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseType;

class CourseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CourseType::create([
            'id'=>1,
            'name' => 'In presenza',
        ]);
        CourseType::create([
            'id'=>2,
            'name' => 'On-line',
        ]);
        CourseType::create([
            'id'=>3,
            'name' => 'Ibrido (on-line e in presenza)',
        ]);
    }
}
