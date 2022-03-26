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

            $table->string('locale');

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->unique(['department_id', 'locale']);

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('keyword')->nullable();
            $table->longText('description')->nullable();
            
            $table->index(['name', 'locale','keyword','slug']);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('department_translations');
    }
}
