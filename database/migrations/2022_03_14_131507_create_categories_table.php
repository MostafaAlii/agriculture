<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
  
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('parent_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('admin')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('admin')->cascadeOnDelete();            
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
