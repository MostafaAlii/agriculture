<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
   
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {

            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('departments')->cascadeOnDelete();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('province_id')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('village_id')->nullable()->constrained()->cascadeOnDelete();
            // $table->foreignId('created_by')->nullable()->constrained('admin')->cascadeOnDelete();
            // $table->foreignId('updated_by')->nullable()->constrained('admin')->cascadeOnDelete();            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
