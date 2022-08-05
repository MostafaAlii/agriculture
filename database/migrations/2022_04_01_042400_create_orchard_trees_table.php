<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchardTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchard_trees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tree_id')->references('id')->on('trees')->onDelete('cascade');
            $table->foreignId('orchard_id')->references('id')->on('orchards')->onDelete('cascade');
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
        Schema::dropIfExists('orchard_trees');
    }
}
