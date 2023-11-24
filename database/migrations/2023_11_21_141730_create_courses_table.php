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
            $table->foreign('cfp_id')->references('id')->on('c_f_p_s')->onDelete('cascade');
            $table->string('code');
            $table->string('topic');
            $table->text('description');
            $table->string('banner');
            $table->integer('course_type_id');
            $table->decimal('list_price',10,2);
            $table->integer('duration_hours');
            $table->dateTime('available_from');
            $table->dateTime('available_until');
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
