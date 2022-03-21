<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Blog;
use Illuminate\Support\Facades\Schema;
class CreateBlogsTable extends Migration {
    public function up() {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->tinyInteger('visibility')->default(Blog::PUBLIC_VISIBIILTY);
            $table->foreignId('admin_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('blogs');
    }
}
