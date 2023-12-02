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
        Schema::table('students', function(Blueprint $table) {
            //$table->foreignId('student_status_id')->references('id')->on('student_statuses');
            $table->bigInteger('student_status_id')->after('parsifal_enrolled_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('students', function(Blueprint $table) {
            //$table->dropConstrainedForeignId('student_status_id');
            $table->dropColumn('student_status_id');
        });    }
};
