<?php
namespace Database\Seeders;
use App\Models\{Tag,Image, Blog,Category};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB,Schema};
class BlogSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('blogs')->truncate();
        Blog::factory()->count(10)->create();
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
    }
}