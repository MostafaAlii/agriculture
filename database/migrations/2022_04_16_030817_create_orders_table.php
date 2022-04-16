<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrdersTable extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('referance_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained()->nullOnDelete();
            $table->double('subtotal')->default(0.00);
            $table->string('discount_code')->nullable();
            $table->double('discount')->default(0.00);
            $table->double('shipping')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->double('total')->default(0.00);
            $table->string('currency')->default('USD');
            $table->unsignedTinyInteger('order_status')->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
