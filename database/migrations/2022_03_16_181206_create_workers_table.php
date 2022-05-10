<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->unsignedBigInteger('sales')->default(0);
            $table->foreignId('country_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('province_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('village_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->default('1')->constrained()->cascadeOnDelete();
            $table->date('birthdate')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('workers');
    }
}
