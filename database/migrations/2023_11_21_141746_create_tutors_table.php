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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->text('description');
            $table->string('email');
            $table->string('phone');
            $table->dateTime('available_from');
            $table->dateTime('available_until');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
