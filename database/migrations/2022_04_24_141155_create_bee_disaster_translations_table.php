<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeeDisasterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bee_disaster_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->string('locale');
            $table->unsignedBigInteger('bee_disaster_id');
            $table->unique(['bee_disaster_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('bee_disaster_id')->references('id')->on('bee_disasters')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bee_disaster_translations');
    }
}
