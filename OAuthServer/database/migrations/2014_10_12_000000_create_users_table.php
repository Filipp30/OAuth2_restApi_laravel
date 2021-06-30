<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('email')->unique();
            $table->boolean('email_verification')->default(false);
            $table->string('phone_number')->unique()->nullable(true);
            $table->boolean('phone_number_verification')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
