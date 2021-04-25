<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobRequiredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_requireds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_role_title')->nullable();
            $table->foreignId('major_id')->nullable();
            $table->text('job_target')->nullable();
            $table->enum('level',['fresh_graduate','average','high'])->default('average');
            $table->foreignId('country_id')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('notice_period')->nullable();
            $table->enum('working_type',['full_time','part_time','remotely'])->default('remotely');
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
        Schema::dropIfExists('job_requireds');
    }
}
