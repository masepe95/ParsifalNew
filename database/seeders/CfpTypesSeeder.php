<?php

namespace Database\Seeders;

use App\Models\CFPType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CfpTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CFPType::create([
            'id'=>1,
            'name' => 'ITS',
        ]);
        CFPType::create([
            'id'=>2,
            'name' => 'CFP',
        ]);
        CFPType::create([
            'id'=>3,
            'name' => 'Ente Formativo Privato',
        ]);
    }
}
