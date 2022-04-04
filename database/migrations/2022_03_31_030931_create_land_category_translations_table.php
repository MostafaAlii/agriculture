<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandCategoryTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('land_category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('locale');
            $table->unsignedBigInteger('land_category_id');
            $table->unique(['land_category_id', 'locale']);
            $table->index(['category_name', 'locale']);
            $table->foreign('land_category_id')->references('id')->on('land_categories')->onDelete('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('land_category_translations');
    }
}
