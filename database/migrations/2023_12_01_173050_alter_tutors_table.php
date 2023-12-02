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
        Schema::table('tutors', function(Blueprint $table) {
            //$table->foreignId('tutor_type_id')->references('id')->on('tutor_types');
            $table->bigInteger('tutor_type_id')->after('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('tutors', function(Blueprint $table) {
            //$table->dropConstrainedForeignId('tutor_type_id');
            $table->dropColumn('tutor_type_id');
        });
    }
};
