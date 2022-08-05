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

            $table->foreignId('village_id')->references('id')->on('villages')->onDelete('cascade');

            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->integer('old_beehive_count');
            $table->integer('new_beehive_count');
            $table->integer('died_beehive_count');
            $table->integer('cost');
            $table->double('annual_old_product_beehive',[15,2]);
            $table->double('annual_new_product_beehive',[15,2]);
            $table->foreignId('unit_id')->references('id')->on('units');
            $table->enum('supported_side',['private','govermental','international organizations']);

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
