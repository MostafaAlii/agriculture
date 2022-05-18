<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTeamTranslationsTable extends Migration {
    public function up() {
        Schema::create('team_translations', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

            $table->string('locale');
            $table->unique(['team_id', 'locale']);
            
            $table->string('name');
            $table->string('position');
            $table->longText('description');

            $table->index(['name', 'locale']);
            
        });
    }

    public function down() {
        Schema::dropIfExists('team_translations');
    }
}
