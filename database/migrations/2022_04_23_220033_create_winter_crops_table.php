<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinterCropsTable extends Migration
{

    public function up()
    {
        Schema::create('winter_crops', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('winter_crops');
    }
}
