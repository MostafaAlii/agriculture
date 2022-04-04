<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreeTypeTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('tree_type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('tree_type');
            $table->string('locale');
            $table->unsignedBigInteger('tree_type_id');
            $table->unique(['tree_type_id', 'locale']);
            $table->index(['tree_type', 'locale']);
            $table->foreign('tree_type_id')->references('id')->on('tree_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tree_type_translations');
    }
}
