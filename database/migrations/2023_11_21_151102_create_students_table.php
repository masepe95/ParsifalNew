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
            $table->foreignId('formation_event_id')->references('id')->on('formation_events'); // => valutare se tenere così
            //$table->bigInteger('formation_event_id'); // o così perchè anche se elimino la gerarchia dei CFP/BRANCHES/COURSES/FROMATION_EVENTS che mi lega il Candidato, poi me lo voglio conservare
            $table->string('email');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->foreignId('origin_id')->references('id')->on('origins');
            $table->dateTime('parsifal_enrolled_at')->nullable();
            //$table->foreignId('parsifal_student_status_id')->references('id')->on('parsifal_student_statuses');
            $table->dateTime('camelot_preregistration_email_sent_at')->nullable();
            $table->integer('camelot_candidate_id')->nullable();
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
