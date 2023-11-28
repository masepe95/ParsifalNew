<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            'id'=>99,
            'name' => 'Admin',
        ]);
        Role::create([
            'id'=>1,
            'name' => 'CFP',
        ]);
        Role::create([
            'id'=>2,
            'name' => 'Branch (Filiale, Sede Secondaria)',
        ]);
    }
}
