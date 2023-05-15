<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration {
    
    public function down() {
        Schema::dropIfExists('permissions');
    }

    public function up() {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            
			$table->string('name', 30);
			$table->string('description', 150);
             
            $table->timestamps();
            $table->softDeletes();
        });
    }
}

