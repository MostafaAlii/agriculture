<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{

    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->double('location_x')->nullable();
            $table->double('location_y')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
