<?php
namespace Database\Seeders;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
class TagSeeder extends Seeder {
    public function run() {
        DB::table('tags')->delete();
        Tag::factory(35)->create();
    }
}
