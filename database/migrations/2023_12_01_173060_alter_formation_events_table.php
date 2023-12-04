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
        Schema::table('formation_events', function (Blueprint $table) {
            //$table->foreignId('course_type_id')->references('id')->on('course_types');
            $table->bigInteger('course_type_id')->after('course_id');
            //$table->foreignId('tutor_id')->references('id')->on('tutors');
            $table->bigInteger('tutor_id')->after('course_type_id');
            $table->string('name')->nullable()->after('tutor_id');
            $table->string('banner')->nullable()->after('tutor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('formation_events', function(Blueprint $table) {
            //$table->dropConstrainedForeignId('course_type_id');
            $table->dropColumn('course_type_id');
            //$table->dropConstrainedForeignId('tutor_id');
            $table->dropColumn('tutor_id');
            $table->dropColumn('banner');
            $table->dropColumn('name');
        });
    }
};
