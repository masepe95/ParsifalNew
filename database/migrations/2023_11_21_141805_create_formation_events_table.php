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
        Schema::create('formation_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->integer('course_id');
            $table->integer('tutor_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('max_students');
            $table->decimal('actual_price',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_events');
    }
};
