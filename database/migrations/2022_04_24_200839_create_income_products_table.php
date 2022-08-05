<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeProductsTable extends Migration
{
   
    public function up()
    {
        Schema::create('income_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->references('id')->on('countries')->onDelete('cascade');
           $table->enum('country_product_type',['local','iraq','imported']);
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->foreignId('unit_id')->references('id')->on('units');
            $table->foreignId('wholesale_id')->references('id')->on('wholesales')->onDelete('cascade');

//            $table->string('admin_dep_name');

            $table->foreignId('whole_product_id')->references('id')->on('whole_products')->onDelete('cascade');
            $table->double('income_product_amount','15','2');
            $table->double('income_product_price','15','2');
            $table->foreignId('currency_id')->references('id')->on('currencies');

            $table->date('income_product_date');

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
        Schema::dropIfExists('income_products');
    }
}
