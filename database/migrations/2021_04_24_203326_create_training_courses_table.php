<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->enum('type',['course','training'])->default('course');
            $table->string('title')->nullable();
            $table->string('foundation_name')->nullable();
            $table->integer('total_hours')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('graduation_file')->nullable();
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
        Schema::dropIfExists('training_courses');
    }
}
