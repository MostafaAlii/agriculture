<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcome_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreignId('province_id')->nullable()->references('id')->on('provinces')->onDelete('cascade');
            $table->foreignId('area_id')->nullable()->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('admin_department_id')->references('id')->on('admin_departments')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->foreignId('unit_id')->references('id')->on('units');

            $table->foreignId('whole_product_id')->references('id')->on('whole_products')->onDelete('cascade');
            $table->string('outcome_product_amount');
            $table->decimal('outcome_product_price');
            $table->foreignId('currency_id')->references('id')->on('currencies');

            $table->date('outcome_product_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outcome_products');
    }
}
