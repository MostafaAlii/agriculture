<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgriServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agri_service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('agri_service_id');
            $table->unique(['agri_service_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('agri_service_id')->references('id')->on('agri_services')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agri_service_translations');
    }
}
