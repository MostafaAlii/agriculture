<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProductDepartmentsTable extends Migration {
    public function up() {
        Schema::create('product_departments', function (Blueprint $table) {
            $table->primary(['department_id', 'product_id']);
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down() {
        Schema::dropIfExists('product_departments');
    }
}
