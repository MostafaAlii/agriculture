<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOptionTranslationsTable extends Migration {
    public function up() {
        Schema::create('option_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->foreignId('option_id')->constrained()->cascadeOnDelete();
            $table->unique(['option_id', 'locale']);
            $table->index(['name', 'locale']);
        });
    }

    public function down() {
        Schema::dropIfExists('option_translations');
    }
}
