<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable();
            $table->string('job_title')->nullable();
            $table->foreignId('major_id')->nullable();
            $table->enum('level',['fresh_graduate','average','high'])->default('average');
            $table->enum('qualification_type',['secondary','diploma','bachelor','ma','phd'])->default('bachelor');
            $table->enum('sex',['male','female'])->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('experience_years')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->json('location')->nullable();
            $table->enum('working_type',['full_time','part_time','remotely'])->default('remotely');
            $table->text('description')->nullable();
            $table->boolean('show_company')->default(true);
            $table->enum('pay_type',['bank','online'])->default('bank');
            $table->string('invoice_image')->nullable();
            $table->enum('status',['pending','approved','rejected'])->default('pending');
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
        Schema::dropIfExists('jobs');
    }
}
