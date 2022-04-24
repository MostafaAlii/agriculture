<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('crop_id');
            $table->unique(['crop_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_translations');
    }
}
