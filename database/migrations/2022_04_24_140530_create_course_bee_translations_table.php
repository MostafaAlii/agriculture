<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseBeeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_bee_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->string('locale');
            $table->unsignedBigInteger('course_bee_id');
            $table->unique(['course_bee_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('course_bee_id')->references('id')->on('course_bees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_bee_translations');
    }
}
