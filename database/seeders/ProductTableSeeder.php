<?php
namespace Database\Seeders;
use App\Models\{Product, Category, Unit, Tag};
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Database\Seeder;
class ProductTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Product::factory()->count(5)->create();
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
        // Units Attach ::
        $Units = Unit::get();
        Product::all()->each(function ($product) use ($Units) {
            $product->units()->attach(
                $Units->random()->pluck('id')->toArray()
            );
        });
        Schema::enableForeignKeyConstraints();
    }
}