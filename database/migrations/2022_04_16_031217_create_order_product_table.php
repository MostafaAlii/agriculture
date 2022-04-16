<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrderProductTable extends Migration {
    public function up() {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('order_product');
    }
}
