<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->enum('qualification_type',['secondary','diploma','bachelor','ma','phd'])->default('bachelor');
            $table->string('foundation_name')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('average_calculation_system')->nullable();
            $table->dateTime('graduation_date')->nullable();
            $table->string('graduation_degree')->nullable();
            $table->string('specialization')->nullable();
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
        Schema::dropIfExists('qualifications');
    }
}
