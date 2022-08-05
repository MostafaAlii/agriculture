<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerServiceAgrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_service_agris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_service_id')->references('id')->on('farmer_services')->onDelete('cascade');
            $table->foreignId('agri_service_id')->references('id')->on('agri_services')->onDelete('cascade');

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
        Schema::dropIfExists('farmer_service_agris');
    }
}
