<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTagTranslationsTable extends Migration {
    public function up() {
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unique(['tag_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tag_translations');
    }
}
