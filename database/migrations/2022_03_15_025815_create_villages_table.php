<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateVillagesTable extends Migration {
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('villages');
    }
}
