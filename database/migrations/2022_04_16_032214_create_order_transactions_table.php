<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrderTransactionsTable extends Migration {
    public function up()
    {
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('transaction')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('payment_result')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('order_transactions');
    }
}
