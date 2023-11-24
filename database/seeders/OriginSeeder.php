<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Origin;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Origin::truncate();
        Origin::create([
            'id'=>1,
            'name' => 'Camelot Native',
        ]);
        Origin::create([
            'id'=>2,
            'name' => 'Parsifal Native',
        ]);
    }
}
