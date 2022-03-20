<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateAdminsTable extends Migration {
    public function up() {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->enum('type',['admin','employee'])->default('admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->foreignId('country_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('province_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('village_id')->default('1')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->default('1')->constrained()->cascadeOnDelete();
            $table->date('birthdate')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('admins');
    }
}
