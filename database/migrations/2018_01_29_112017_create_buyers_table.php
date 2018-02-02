<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    public function up()
    {
        Schema::create('buyers', function(Blueprint $table){
            $table->increments('buyer_id');
            $table->string('owner_name');
            $table->string('company_name');
            $table->string('company_reg_number');
            $table->string('ic_number');
            $table->string('company_address');
            $table->string('phone_number');
            $table->string('handphone_number');
            $table->string('email_address');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('buyers');
    }
}
