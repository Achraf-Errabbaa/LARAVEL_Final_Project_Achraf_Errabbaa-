<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_classmodels_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassModelsTable extends Migration
{
    public function up()
    {
        Schema::create('classmodels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('max_participants');
            $table->string('category')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('classmodels');
    }
}
