<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchardTreeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchard_tree_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tree_type_id')->references('id')->on('tree_types')->onDelete('cascad');
            $table->foreignId('orchard_id')->references('id')->on('orchards')->onDelete('cascad');
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
        Schema::dropIfExists('orchard_tree_types');
    }
}
