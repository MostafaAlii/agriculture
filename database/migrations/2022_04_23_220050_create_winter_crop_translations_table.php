<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinterCropTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('winter_crop_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('winter_crop_id');
            $table->unique(['winter_crop_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('winter_crop_id')->references('id')->on('winter_crops')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('winter_crop_translations');
    }
}
