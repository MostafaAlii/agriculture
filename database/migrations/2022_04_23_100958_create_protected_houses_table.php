<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtectedHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protected_houses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('village_id')->references('id')->on('villages')->onDelete('cascade');

            $table->integer('average_product_annual');
            $table->integer('count_protected_house');

            $table->foreignId('unit_id')->references('id')->on('units');
            $table->enum('supported_side',['private','govermental','international organizations']);
            $table->enum('status',['active','inactive'])->default('active');

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
        Schema::dropIfExists('protected_houses');
    }
}
