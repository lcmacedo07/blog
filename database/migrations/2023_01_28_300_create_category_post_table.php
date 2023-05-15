<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryPostTable extends Migration
{
    public function down()
    {
        Schema::dropIfExists('category_post');
    }

    public function up()
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('post_id')->unsigned();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->timestamps();
			$table->softDeletes();
        });
    }

}