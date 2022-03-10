<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDepartmentTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('department_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unsignedBigInteger('department_id');
            $table->unique(['department_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('department_translations');
    }
}
