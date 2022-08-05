<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerServicesTable extends Migration
{

    public function up()
    {
        Schema::create('farmer_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('village_id')->references('id')->on('villages')->onDelete('cascade');


            $table->integer('agri_services_count');
            $table->integer('agri_t_services_count');
            $table->integer('water_services_count');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('farmer_services');
    }
}
