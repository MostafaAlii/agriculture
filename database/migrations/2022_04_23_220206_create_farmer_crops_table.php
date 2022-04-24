<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerCropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('admin_department_id')->references('id')->on('admin_departments')->onDelete('cascade');
            $table->foreignId('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->foreignId('land_category_id')->references('id')->on('land_categories')->onDelete('cascade');

            $table->string('phone');
            $table->string('email');

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
        Schema::dropIfExists('farmer_crops');
    }
}
