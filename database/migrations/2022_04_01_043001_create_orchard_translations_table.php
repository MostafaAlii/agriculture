<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchardTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchard_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('supported_side',['governmental','private','international_organizations'])->default('governmental');
            $table->string('locale');
            $table->unsignedBigInteger('orchard_id');
            $table->unique(['orchard_id', 'locale']);
            $table->index(['supported_side', 'locale']);
            $table->foreign('orchard_id')->references('id')->on('orchards')->onDelete('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('orchard_translations');
    }
}
