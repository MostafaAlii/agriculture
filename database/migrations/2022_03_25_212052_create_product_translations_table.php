<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductTranslationsTable extends Migration {
    public function up() {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->unique(['product_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->longText('other_data')->nullable();
            $table->longText('reason')->nullable();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::dropIfExists('product_translations');
    }
}
