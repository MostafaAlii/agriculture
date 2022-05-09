<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_translations', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('locale');
            $table->unsignedBigInteger('unit_id');
            $table->unique(['Name', 'locale']);
            $table->index(['Name', 'locale']);
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
