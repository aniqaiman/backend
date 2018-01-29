<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    public function up()
    {
        Schema::create('drivers', function(Blueprint $table){
            $table->increments('driver_id');
            $table->string('name');
            $table->string('ic_number');
            $table->string('home_address');
            $table->integer('phone_number');
            $table->integer('license_number');
            $table->string('drivers_license');
            $table->date('roadtax_expiry');
            $table->string('type_of_lorry');
            $table->string('lorry_capacity');
            $table->string('location_to_cover');
            $table->string('lorry_plate_number');
            $table->string('bank_name');
            $table->string('bank_acc_holder_name');
            $table->string('bank_acc_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('drivers');
    }
}
