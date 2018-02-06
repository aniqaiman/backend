<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVegetablesTable extends Migration
{
    public function up()
    {
        Schema::create('vegetables', function(Blueprint $table){
            $table->increments('vegetable_id');
            $table->string('vegetable_name');
            $table->string('vegetable_grade');
            $table->string('vegetable_price');
            $table->string('vegetable_image');
            $table->string('vegetable_quantity');
            $table->string('vegetable_harvest_duration');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('vegetables');
    }
}
