<?php
namespace Database\Seeders;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class BlogSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('blogs')->truncate();
        Blog::factory()->count(30)->create();
        $Tags = Tag::get();
        Blog::all()->each(function ($blog) use ($Tags) {
            $blog->tags()->attach(
                $Tags->random()->pluck('id')->toArray()
            );
        });
        $Categories = Category::get();
        Blog::all()->each(function ($blog) use ($Categories) {
            $blog->categories()->attach(
                $Categories->random()->pluck('id')->toArray()
            );
        });
        Schema::enableForeignKeyConstraints();
    }
}
