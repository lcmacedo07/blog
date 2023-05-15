<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{

    public function down()
    {
        Schema::dropIfExists('roles');
    }
   
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('description', 150);
            
            $table->timestamps();
			$table->softDeletes();
        });
    }
}