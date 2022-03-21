<?php
namespace Database\Seeders;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
class BlogSeeder extends Seeder {
    public function run() {
        DB::table('blogs')->delete();
        Blog::factory(30)->create();
    }
}
