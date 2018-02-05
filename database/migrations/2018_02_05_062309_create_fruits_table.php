<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFruitsTable extends Migration
{
    public function up()
    {
        Schema::create('fruits', function(Blueprint $table){
            $table->increments('fruit_id');
            $table->string('fruit_name');
            $table->string('fruit_grade');
            $table->string('fruit_price');
            $table->string('fruit_image');
            $table->string('fruit_quantity');
            $table->string('fruit_harvest_duration');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('fruits');
    }
}
