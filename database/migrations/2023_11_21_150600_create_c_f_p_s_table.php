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
        Schema::create('c_f_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('company_name');
            $table->string('vat_number',20);
            $table->string('address');
            $table->string('city');
            $table->string('district',2);
            $table->string('postal_code',6);
            $table->string('manager_name');
            $table->string('manager_surname');
            $table->string('email');
            $table->string('phone');
            $table->string('social_fb');
            $table->string('social_ig');
            $table->string('social_li');
            $table->string('social_x');
            $table->text('description');
            $table->string('logo');
            $table->boolean('internship_enabled');
            $table->boolean('stage_enabled');
            $table->foreignId('cfp_formation_type_id')->references('id')->on('c_f_p_formation_types');
            $table->foreignId('cfp_type_id')->references('id')->on('c_f_p_types');
            $table->foreignId('cfp_accreditation_type_id')->references('id')->on('c_f_p_accreditation_types');
            $table->foreignId('cfp_course_type_id')->references('id')->on('c_f_p_course_types');
            $table->foreignId('cfp_audience_type_id')->references('id')->on('c_f_p_audience_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_f_p_s');
    }
};
