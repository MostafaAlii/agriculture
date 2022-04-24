<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecipitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precipitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('admin_department_id')->references('id')->on('admin_departments')->onDelete('cascade');
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->decimal('precipitation_rate');
            $table->date('date');
            $table->foreignId('unit_id')->references('id')->on('units');

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
        Schema::dropIfExists('precipitations');
    }
}
