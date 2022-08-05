<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->mediumText('reason')->nullable();
            $table->unique(['order_id', 'locale']);
            $table->index(['locale']);
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_translations');
    }
}
