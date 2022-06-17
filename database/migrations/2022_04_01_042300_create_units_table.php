<?php
use App\Models\Unit;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUnitsTable extends Migration
{

    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('visibility')->default(Unit::GENERAL);
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
        Schema::dropIfExists('units');
    }
}
