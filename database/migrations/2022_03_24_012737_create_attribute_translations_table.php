<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAttributeTranslationsTable extends Migration {
    public function up() {
        Schema::create('attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('attribute_id');
            $table->unique(['attribute_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('attribute_translations');
    }
}
