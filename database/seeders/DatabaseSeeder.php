<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*
         * seeds
         *

        TIPI DI FORMAZIONE:
        1-	INIZIALE
        2-	CONTINUA

        TIPOLOGIA ENTE FORMATIVO
        1-	ITS
        2-	CFP
        3-	ENTE FORMATIVO PRIVATO

        ACCREDITAMENTO
        1-	SI
        2-	NO

        TIPOLOGIA DI CORSI
        1-	FINANZIATI
        2-	A CATALOGO

        DESTINATARI
        1-	DISOCCUPATI
        2-	OCCUPATI

        ORIGIINS
        1-	NATIVO CAMELOT
        2-	NATIVO PARSIFAL

        */
//        $this->call('Database\Seeders\RolesSeeder');
//        $this->call('Database\Seeders\UsersSeeder');
//        $this->call('Database\Seeders\OriginsSeeder');
//        $this->call('Database\Seeders\CourseTypesSeeder');
        $this->call('Database\Seeders\TutorTypesSeeder');
        $this->call('Database\Seeders\InternshipStatusesSeeder');
        $this->call('Database\Seeders\StudentStatusesSeeder');
//        $this->call('Database\Seeders\CfpAccreditationTypesSeeder');
//        $this->call('Database\Seeders\CfpAudienceTypesSeeder');
//        $this->call('Database\Seeders\CfpCourseTypesSeeder');
//        $this->call('Database\Seeders\CfpFormationTypesSeeder');
//        $this->call('Database\Seeders\CfpTypesSeeder');
    }
}
