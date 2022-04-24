<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeeKeeperCourseBeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bee_keeper_course_bee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bee_keeper_id')->references('id')->on('bee_keepers')->onDelete('cascade');
            $table->foreignId('course_bee_id')->references('id')->on('course_bees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bee_keeper_course_bee');
    }
}
