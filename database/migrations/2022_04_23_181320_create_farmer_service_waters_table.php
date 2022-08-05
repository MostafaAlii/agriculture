<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerServiceWatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_service_waters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_service_id')->references('id')->on('farmer_services')->onDelete('cascade');
            $table->foreignId('water_service_id')->references('id')->on('water_services')->onDelete('cascade');

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
        Schema::dropIfExists('farmer_service_waters');
    }
}
