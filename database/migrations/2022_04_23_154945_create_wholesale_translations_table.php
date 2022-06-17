<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWholesaleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wholesale_translations', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('locale');
            $table->unsignedBigInteger('wholesale_id');
            $table->unique(['wholesale_id', 'locale']);
            $table->index(['Name', 'locale']);
            $table->foreign('wholesale_id')->references('id')->on('wholesales')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wholesale_translations');
    }
}
