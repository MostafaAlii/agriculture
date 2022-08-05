<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('land_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('land_categories');
    }
}
