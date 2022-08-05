<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductTagsTable extends Migration {
    public function up() {
        Schema::create('product_tags', function (Blueprint $table) {
            //$table->id();
            //$table->primary(['tag_id', 'product_id']);
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::dropIfExists('product_tags');
    }
}
