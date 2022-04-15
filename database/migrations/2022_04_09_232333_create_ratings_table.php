<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Rating;
class CreateRatingsTable extends Migration {
    public function up() {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id')->cascadeOnDelete();
            $table->enum('rating', [Rating::MIN_STARS_RATE,2,3,4,Rating::MAX_STARS_RATE])->default(Rating::MIN_STARS_RATE);
            $table->morphs('rateable');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('ratings');
    }
}
