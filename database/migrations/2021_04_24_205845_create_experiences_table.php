<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('job_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('previous_experience')->nullable();
            $table->text('job_description')->nullable();
            $table->foreignId('major_id')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('foundation_name')->nullable();
            $table->foreignId('foundation_major_id')->nullable();
            $table->integer('foundation_members_count')->nullable();
            $table->string('latest_salary')->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
