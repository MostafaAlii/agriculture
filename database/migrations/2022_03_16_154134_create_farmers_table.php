<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateFarmersTable extends Migration {
    public function up() {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            // $table->foreignId('area_id')->constrained()->onDelete('cascade')->nullable()->default(1);
            // $table->foreignId('province_id')->constrained()->onDelete('cascade')->nullable()->default(1);
            // $table->foreignId('country_id')->constrained()->onDelete('cascade')->nullable()->default(1);
            // $table->foreignId('state_id')->constrained()->onDelete('cascade')->nullable()->default(1);
            // $table->foreignId('village_id')->constrained()->onDelete('cascade')->nullable()->default(1);
            // $table->foreignId('department_id')->constrained()->onDelete('cascade')->nullable()->default(1);
            $table->date('birthdate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('farmers');
    }
}
