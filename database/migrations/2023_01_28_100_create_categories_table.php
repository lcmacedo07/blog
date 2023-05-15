<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function down()
    {
        Schema::dropIfExists('categories');
    }

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            // $table->string('image')->default('default.png');

            $table->timestamps();
			$table->softDeletes();
        });
    }

}