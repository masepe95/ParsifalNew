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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('cfp_id')->references('id')->on('c_f_p_s')->onDelete('cascade');
            $table->string('email');
            //$table->string('password');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('district',2)->nullable();
            $table->string('postal_code',5)->nullable();
            $table->decimal('gps_lat',10,6)->nullable();
            $table->decimal('gps_lon',10,6)->nullable();
            $table->string('manager_name')->nullable();
            $table->string('manager_surname')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
