<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiringLawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hiring_laws', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('note_ar')->nullable();
            $table->string('note_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hiring_laws');
    }
}
