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
            $table->string('company_name')->nullable();
            $table->string('vat_number', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district', 2)->nullable();
            $table->string('postal_code', 6)->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('social_fb')->nullable();
            $table->string('social_ig')->nullable();
            $table->string('social_li')->nullable();
            $table->string('social_x')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('internship_enabled')->nullable();
            $table->boolean('stage_enabled')->nullable();
            $table->bigInteger('cfp_formation_type_id')->nullable();
            $table->bigInteger('cfp_type_id')->nullable();
            $table->bigInteger('cfp_accreditation_type_id')->nullable();
            $table->bigInteger('cfp_course_type_id')->nullable();
            $table->bigInteger('cfp_audience_type_id')->nullable();
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
