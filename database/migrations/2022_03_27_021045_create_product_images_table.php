<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductImagesTable extends Migration {
    public function up() {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('product_images');
    }
}
