<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeeKeepersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bee_keepers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('admin_department_id')->references('id')->on('admin_departments')->onDelete('cascade');
            $table->foreignId('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->integer('old_beehive_count');
            $table->integer('new_beehive_count');
            $table->integer('died_beehive_count');
            $table->decimal('annual_old_product_beehive');
            $table->decimal('annual_new_product_beehive');
            $table->foreignId('unit_id')->references('id')->on('units');
            $table->foreignId('supported_side_id')->references('id')->on('supported_sides');
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
        Schema::dropIfExists('bee_keepers');
    }
}
