<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummerCropFarmerCropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summer_crop_farmer_crop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_crop_id')->references('id')->on('farmer_crops')->onDelete('cascade');
            $table->foreignId('summer_crop_id')->references('id')->on('summer_crops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summer_crop_farmer_crop');
    }
}
