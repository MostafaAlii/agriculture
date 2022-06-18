<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            // mandatory fields
            //$table->bigIncrements('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
            $table->string('locale')->index();
            $table->unsignedBigInteger('setting_id');

            // Foreign key to the main model
            $table->unique(['setting_id', 'locale']);
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('cascade');

            // Actual fields you want to translate

            $table->string('site_name');
            $table->longText('address')->nullable();
            $table->longText('message_maintenance')->nullable();


        });
    }


    public function down()
    {
        Schema::dropIfExists('setting_translations');
    }
}
