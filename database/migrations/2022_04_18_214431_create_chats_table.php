<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->morphs('chatable');
            // $table->Integer('chatable_id');
            // $table->string('chatable_type');
            $table->string('name');
            $table->string('email');
            $table->string('image');
            
            $table->text('message_text');
            
            // $table->foreignId('user_id')->constrained();
           //$table->string('message_text');
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
        Schema::dropIfExists('chats');
    }
}
