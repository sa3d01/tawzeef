<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['ADMIN','USER','COMPANY'])->default('USER');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('country_id')->nullable();
            $table->foreignId('city_id')->nullable();
            //مجال العمل للشركة -- مجال العمل للموظف
            $table->foreignId('major_id')->nullable();
            //عدد موظفين الشركة-عدد الافراد اللى بيعولهم الموظف
            $table->integer('members_count')->default(0);
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->enum('hear_by',['friend','ad','social','google'])->nullable();
            $table->string('last_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->boolean('banned')->nullable()->default(false);
            $table->boolean('approved')->nullable()->default(false);
            $table->string('reject_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
