<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinterCropFarmerCropTable extends Migration
{

    public function up()
    {
        Schema::create('winter_crop_farmer_crop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_crop_id')->references('id')->on('farmer_crops')->onDelete('cascade');
            $table->foreignId('winter_crop_id')->references('id')->on('winter_crops')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('winter_crop_farmer_crop');
    }
}
