<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function(Blueprint $table){
            $table->increments('group_id');
            $table->string('group_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExist('groups');
    }
}
