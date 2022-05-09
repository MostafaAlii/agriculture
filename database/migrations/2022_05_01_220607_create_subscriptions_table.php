<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSubscriptionsTable extends Migration {
    public function up() {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('email')->unique()->index();
            $table->date('subscription_end_date');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('subscriptions');
    }
}
