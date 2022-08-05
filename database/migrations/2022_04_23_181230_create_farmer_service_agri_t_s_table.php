<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerServiceAgriTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_service_agri_t_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_service_id')->references('id')->on('farmer_services')->onDelete('cascade');
            $table->foreignId('agri_t_service_id')->references('id')->on('agri_t_services')->onDelete('cascade');

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
        Schema::dropIfExists('farmer_service_agri_t_s');
    }
}
