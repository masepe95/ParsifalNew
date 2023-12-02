<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            // Nome, Cognome, Data di nascita, Indirizzo completo, email o telefono (almeno uno dei campi deve essere compilato),
            // nome del corso di formazione, data di inizio, data di fine, stato iscrizione camelot (bool),
            // Status processo di assunzione Camelot
            $table->id();
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('course_name')->nullable();
            $table->string('tutor_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('score')->nullable();
            $table->dateTime('camelot_sign_up_date')->nullable();
            $table->boolean('camelot_sign_up_status')->default(0);
            $table->integer('camelot_recruitment_process_step_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
