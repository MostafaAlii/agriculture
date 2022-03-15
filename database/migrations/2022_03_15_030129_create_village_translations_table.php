<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateVillageTranslationsTable extends Migration {
    public function up() {
        Schema::create('village_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unique(['village_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('village_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('village_translations');
    }
}
