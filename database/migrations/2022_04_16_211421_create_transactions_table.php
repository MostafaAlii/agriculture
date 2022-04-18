<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Transaction;
class CreateTransactionsTable extends Migration {
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->enum('mode',[Transaction::COD,Transaction::CARD,Transaction::PAYPAL]);
            $table->enum('status',[Transaction::PENDING, Transaction::APPROVED,Transaction::DECLINED,Transaction::REFUNDED])->default(Transaction::PENDING);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('transactions');
    }
}
