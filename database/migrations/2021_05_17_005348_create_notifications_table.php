<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->nullable();
            $table->string('model')->nullable();
            $table->foreignId('model_id')->nullable();
            $table->string('note_ar')->nullable();
            $table->string('note_en')->nullable();
            $table->enum('read',['true','false'])->default('false');
            $table->enum('type',['admin','app'])->default('app');
            $table->enum('admin_notify_type',['single','user','company','all'])->nullable();
            $table->json('receivers')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
