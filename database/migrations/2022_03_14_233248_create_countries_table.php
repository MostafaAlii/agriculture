<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCountriesTable extends Migration {
    public function up() {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_logo')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('countries');
    }
}
