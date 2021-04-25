<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            //للموظفيين فقط
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('sex',['male','female'])->nullable();
            $table->string('job_title')->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->enum('social_status',['single','married'])->nullable();
            $table->foreignId('drive_licence_nationality_id')->nullable();
            $table->json('sub_majors')->nullable();
            $table->foreignId('nationality_id')->nullable();
            $table->enum('working_type',['full_time','part_time','remotely'])->nullable();
            //للشركات فقط
            $table->string('foundation_name')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->string('commercial_file')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
