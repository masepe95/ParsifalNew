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
        Schema::table('internships', function(Blueprint $table) {
            //$table->foreignId('internship_status_id')->references('id')->on('internship_statuses');
            $table->bigInteger('internship_status_id')->after('parsifal_enrolled_at');
            //$table->foreignId('tutor_id')->references('id')->on('tutors');
            $table->bigInteger('tutor_id')->after('internship_status_id');
            $table->integer('camelot_candidate_id')->after('camelot_match_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('internships', function(Blueprint $table) {
            //$table->dropConstrainedForeignId('internship_status_id');
            $table->dropColumn('internship_status_id');
            //$table->dropConstrainedForeignId('tutor_id');
            $table->dropColumn('tutor_id');
            $table->dropColumn('camelot_candidate_id');
        });
    }
};
