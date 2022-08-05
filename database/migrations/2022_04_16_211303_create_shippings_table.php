<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateShippingsTable extends Migration {
    public function up() {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
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
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('shippings');
    }
}
