<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductUnitTable extends Migration {
    public function up()
    {
        Schema::create('product_unit', function (Blueprint $table) {
            $table->unsignedInteger('price')->nullable()->default(200);
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::dropIfExists('product_unit');
    }
}
