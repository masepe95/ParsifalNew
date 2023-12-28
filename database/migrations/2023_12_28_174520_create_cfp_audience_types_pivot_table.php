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
        //
        Schema::create('c_f_p_c_f_p_audience_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('c_f_p_id');
            $table->foreignId('c_f_p_audience_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_f_p_c_f_p_audience_type');
    }
};
