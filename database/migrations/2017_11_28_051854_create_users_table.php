<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) 
        {
            $table->increments('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->longtext('address');
            $table->string('phonenumber');
            $table->string('profilepic');
            $table->string('remember_token');
            $table->string('company_name');
            $table->string('company_reg_ic_number');
            $table->string('handphone_number');
            $table->string('bank_name');
            $table->string('bank_acc_holder_name');
            $table->string('bank_acc_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('group_id');
            $table->timestamps();
        });    
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
