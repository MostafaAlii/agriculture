<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rating;
class CreateRatingsTable extends Migration {
    public function up() {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('admins', 'id')->cascadeOnDelete();
            $table->foreignId('farmer_id')->nullable()->constrained('farmers', 'id')->cascadeOnDelete();
            $table->foreignId('vendor_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->morphs('rateable');
            $table->unsignedTinyInteger('rate')->default(Rating::MIN_STARS_RATE);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('ratings');
    }
}
