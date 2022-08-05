<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductsTable extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedFloat('special_price')->nullable();  // Offer Price
            $table->enum('special_price_type',['fixed','precent'])->default('fixed');
            $table->date('special_price_start')->nullable();  // Start Offer Date
            $table->date('special_price_end')->nullable();  // End offer Date
            $table->string('sku')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('status')->default(false);
            $table->foreignId('farmer_id')->nullable()->constrained()->cascadeOnDelete();
            $table->longText('product_location')->nullable();
            $table->integer('qty')->nullable();
            $table->boolean('is_qty')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
}
