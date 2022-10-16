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
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('admin_department_id');
            $table->unique(['admin_department_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('admin_department_id')->references('id')->on('admin_departments')->onDelete('cascade');
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
        Schema::dropIfExists('admin_department_translations');
    }
}
