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
            $table->string('support_mail');
            $table->string('facebook');
            $table->string('inestegram');
            $table->string('twitter');
            $table->string('primary_phone');
            $table->string('secondery_phone')->nullable();
            $table->string('social_link');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
