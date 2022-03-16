<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProvinceTranslationsTable extends Migration
{
    public function up() {
        Schema::create('province_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('locale');
            $table->unique(['province_id', 'locale']);
            $table->index(['name', 'locale']);
            $table->foreignId('province_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('province_translations');
    }
}
