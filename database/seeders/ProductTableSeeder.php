<?php
namespace Database\Seeders;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class ProductTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Product::factory()->count(100)->create();
        // Categories Attach ::
        $Categories = Category::get();
        Product::all()->each(function ($product) use ($Categories) {
            $product->categories()->attach(
                $Categories->random()->pluck('id')->toArray()
            );
        });
        // Tags Attach ::
        $Tags = Tag::get();
        Product::all()->each(function ($product) use ($Tags) {
            $product->tags()->attach(
                $Tags->random()->pluck('id')->toArray()
            );
        });
        Schema::enableForeignKeyConstraints();
    }
}