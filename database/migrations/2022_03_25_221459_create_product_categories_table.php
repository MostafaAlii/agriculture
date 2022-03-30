<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductCategoriesTable extends Migration {
    public function up() {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->primary(['category_id', 'product_id']);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::dropIfExists('product_categories');
    }
}
