<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->foreignId('country_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('province_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('village_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('admin_department_id')->nullable()->constrained()->cascadeOnDelete();
            $table->date('birthdate')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}