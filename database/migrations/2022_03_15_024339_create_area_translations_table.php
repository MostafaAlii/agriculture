<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAreaTranslationsTable extends Migration {
    public function up() {
        Schema::create('area_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unique(['area_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('area_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('area_translations');
    }
}
