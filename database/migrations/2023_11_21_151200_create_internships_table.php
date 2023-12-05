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
        Schema::create('internships', function (Blueprint $table) {
            $table->id(); // TODO [EA:20231205]: Pensare se crearlo come bigInteger in modo da supportare gli insert con id = 0
            //$table->bigInteger('branch_id'); // => valutare se tenere così
            $table->foreignId('branch_id')->references('id')->on('branches'); // O così perchè anche se elimino la gerarchia dei CFP/BRANCHES/COURSE/FROMATION_EVENT che mi lega l'Azienda, poi me la voglio conservare
            $table->integer('camelot_company_id');
            $table->integer('camelot_match_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->dateTime('parsifal_enrolled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
