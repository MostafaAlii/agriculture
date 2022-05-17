<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummerCropTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summer_crop_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('locale');
            $table->unsignedBigInteger('summer_crop_id');
            $table->unique(['summer_crop_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('summer_crop_id')->references('id')->on('summer_crops')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('summer_crop_translations');
    }
}
