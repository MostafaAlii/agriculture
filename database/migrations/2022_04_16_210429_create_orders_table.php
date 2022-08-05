<?php
use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateOrdersTable extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('referance_id')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('subtotal');
            $table->decimal('discount')->default(0);
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile');
            $table->string('email');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('country');
            $table->string('province');
            $table->string('area');
            $table->string('state');
            $table->string('village');
            $table->boolean('is_shipping_different')->default(false);
            $table->string('currency')->default(Order::CURRENCY);
            $table->unsignedTinyInteger('status')->default(Order::ORDERED);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}
