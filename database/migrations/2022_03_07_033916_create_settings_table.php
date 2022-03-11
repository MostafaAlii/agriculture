<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('support_mail')->nullable();
            $table->string('facebook')->nullable();
            $table->string('inestegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('secondery_phone')->nullable();
            $table->enum('status',['open','close'])->default('open');
            $table->string('site_logo')->nullable();
            $table->string('site_icon')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
