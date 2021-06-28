<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFacebookCredentials extends Migration
{

    public function up(){
        Schema::create('user_facebook_credentials', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(true);
            $table->bigInteger('fb_id')->unique();
            $table->string('nickname')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('email')->unique()->nullable(false);
            $table->string('avatar')->nullable(true);
            $table->string('fb_profile_url')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_facebook_credentials');
    }
}
