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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cfp_id')->references('id')->on('c_f_p_s')->onDelete('cascade');
            $table->foreignId('course_type_id')->references('id')->on('course_types')->onDelete('cascade');
            $table->bigInteger('task_id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description');
            $table->string('banner')->nullable();
            $table->decimal('list_price',10,2)->default(0);
            $table->integer('duration_hours')->default(0);
            $table->dateTime('available_from')->nullable();
            $table->dateTime('available_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
