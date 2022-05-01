<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDepartmentsTable extends Migration
{

    public function up()
    {
        Schema::create('admin_departments', function (Blueprint $table) {
            $table->id();
            $table->string('dep_name_ar');
            $table->string('dep_name_en');

            $table->string('desc')->nullable();
            $table->string('keys')->nullable();
            $table->foreignId('parent')->nullable()->references('id')->on('admin_departments')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('admin_departments');
    }
}
