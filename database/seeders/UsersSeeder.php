<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'id'=>0,
            'name' => 'Admin',
            'email' => 'technology@digitransformer.com',
            'password' => 'Pa$$w0rd!',
        ]);
    }
}
