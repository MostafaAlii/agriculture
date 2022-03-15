<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateStateTranslationsTable extends Migration {
    public function up() {
        Schema::create('state_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unique(['state_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('state_translations');
    }
}
