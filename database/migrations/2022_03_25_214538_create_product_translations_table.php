<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductTranslationsTable extends Migration {
    public function up() {
        Schema::create('product_translations', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('product_id');
            $table->string('locale');
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->longText('description');
            $table->unique(['product_id', 'locale']);
            $table->index(['name', 'locale']);
            //$table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::dropIfExists('product_translations');
    }
}
