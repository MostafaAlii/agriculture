<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('village_id')->references('id')->on('villages')->cascadeOnDelete();
            $table->foreignId('admin_id')->references('id')->on('admins')->cascadeOnDelete();
            $table->foreignId('farmer_id')->references('id')->on('farmers')->cascadeOnDelete();
            $table->string('orchard_count');
            $table->string('tree_count_per_orchard');
            $table->string('orchard_area');

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
        Schema::dropIfExists('orchards');
    }
}
