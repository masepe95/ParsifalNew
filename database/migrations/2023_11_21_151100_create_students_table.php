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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formation_event_id'); // foreignId('formation_event_id')->references('id')->on('formation_events'); => no, perchè anche se elimino la gerarchia dei CFP/BRANCHES/COURSES/FROMATION_EVENTS che mi lega il Candidato, poi me lo voglio conservare
            $table->integer('camelot_candidate_id');
            $table->string('email');
            $table->string('phone');
            $table->dateTime('parsifal_enrolled_at');
            $table->dateTime('camelot_preregistration_email_sent_at');
            $table->foreign('origin_id')->references('id')->on('origins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
