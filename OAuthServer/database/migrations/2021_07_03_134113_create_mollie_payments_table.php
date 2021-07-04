<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMolliePaymentsTable extends Migration
{

    public function up(){

        Schema::create('mollie_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->char('mollie_call_id');
            $table->char('profile_id');
            $table->float('amount_value');
            $table->char('amount_currency');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mollie_payment');
    }
}
