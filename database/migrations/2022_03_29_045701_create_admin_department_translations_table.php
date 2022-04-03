<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDepartmentTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('admin_department_translations', function (Blueprint $table) {
            $table->id();
            $table->string('desc');
            $table->string('keys');


            $table->string('locale');

            $table->unsignedBigInteger('admin_department_id');
            $table->unique(['admin_department_id', 'locale']);
            $table->index(['desc', 'locale']);
            $table->foreign('admin_department_id')->references('id')->on('admin_departments')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('admin_department_translations');
    }
}
