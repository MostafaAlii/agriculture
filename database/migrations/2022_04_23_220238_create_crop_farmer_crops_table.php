<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropFarmerCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_farmer_crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_crop_id')->references('id')->on('farmer_crops')->onDelete('cascade');
            $table->foreignId('crop_id')->references('id')->on('crops')->onDelete('cascade');
            $table->double('area','15','2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_farmer_crops');
    }
}
