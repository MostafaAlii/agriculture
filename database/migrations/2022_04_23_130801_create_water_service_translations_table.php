<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('water_service_id');
            $table->unique(['water_service_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('water_service_id')->references('id')->on('water_services')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('water_service_translations');
    }
}
