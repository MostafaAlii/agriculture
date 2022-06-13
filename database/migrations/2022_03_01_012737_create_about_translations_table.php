<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAboutTranslationsTable extends Migration {
    public function up() {
        Schema::create('about_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('locale');
            $table->longText('description');
            $table->unique(['about_id', 'locale']);
           // $table->index(['title', 'locale']);
            //$table->unsignedBigInteger('about_id');
            //$table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade');
            $table->foreignId('about_id')->constrained()->cascadeOnDelete();;
        });
    }

    public function down() {
        Schema::dropIfExists('about_translations');
    }
}
