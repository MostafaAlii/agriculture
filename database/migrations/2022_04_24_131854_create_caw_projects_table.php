<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCawProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caw_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->foreignId('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->string('project_name');
            $table->integer('hall_num');
            $table->integer('animal_count')->nullable();
            $table->enum('food_source',['local','outer']);
            $table->enum('marketing_side',['private','govermental']);
            $table->double('cost','15,2')->default(1);
            $table->enum('type',['caw','ship','fish']);
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
        Schema::dropIfExists('caw_projects');
    }
}
