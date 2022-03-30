<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCategoryTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {

            $table->id();

            $table->string('locale');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unique(['category_id', 'locale']);

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
        Schema::dropIfExists('category_translations');
    }
}
