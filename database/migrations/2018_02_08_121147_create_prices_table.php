<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    public function up()
    {
        Schema::create('prices', function(Blueprint $table){
            $table->increments('price_id');
            $table->string('vegetable_id');
            $table->string('fruit_id');
            $table->string('product_price');
            $table->date('date_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('prices');
    }
}
