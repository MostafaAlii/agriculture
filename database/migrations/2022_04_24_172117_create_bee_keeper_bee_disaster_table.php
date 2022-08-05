<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeeKeeperBeeDisasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bee_keeper_bee_disaster', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bee_keeper_id')->references('id')->on('bee_keepers')->onDelete('cascade');
            $table->foreignId('bee_disaster_id')->references('id')->on('bee_disasters')->onDelete('cascade');
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
        Schema::dropIfExists('bee_keeper_bee_disaster');
    }
}
