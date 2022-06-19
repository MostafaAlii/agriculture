<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddDeliveredCanceledDateToOrdersTable extends Migration {
    public function up() {
        Schema::table('orders', function (Blueprint $table) {
            $table->date('delivered_date')->nullable();
            $table->date('suggestion_delivered_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->date('under_proces_date')->nullable();
            $table->date('refunded_date')->nullable();
            $table->date('push_from_stock_date')->nullable();
            $table->date('reject_date')->nullable();
        });
    }

    public function down() {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('delivered_date','canceled_date');
        });
    }
}
