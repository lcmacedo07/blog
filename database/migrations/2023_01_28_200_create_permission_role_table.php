<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration {

    public function down() {
        Schema::dropIfExists('permission_role');
    }

    public function up() {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');

			$table->integer('permission_id')->unsigned();
			$table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');


            $table->timestamps();
            $table->softDeletes();
        });
    }
}
