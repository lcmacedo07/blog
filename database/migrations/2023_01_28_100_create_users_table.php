<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    public function down() {
        Schema::dropIfExists('users');
    }

    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('role_id')->default(2);
            $table->string('name');
            $table->string('username', 155)->unique();
            $table->string('email', 155)->unique();
            $table->string('password');
            $table->string('image')->default('default.png');
            $table->text('about')->nullable();
            $table->rememberToken();

            $table->timestamps();
			$table->softDeletes();
        });
    }
}
