<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function(Blueprint $table)
        {
            $table->increments('seller_id');
            $table->string('owner_name');
            $table->string('company_name');
            $table->string('registration_number');
            $table->string('ic_number');
            $table->string('farm_address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('handphone_number');
            $table->string('email_address');
            $table->string('password');
            $table->string('group_id')->default(1);
            $table->string('bank_name');
            $table->string('bank_acc_holder_name');
            $table->string('bank_acc_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('sellers');
    }
}
