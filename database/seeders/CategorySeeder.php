<?php
namespace Database\Seeders;

use App\Models\category;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    public function run() {
        
        $count =3;
        $category_names = [
            "القسم الزرارعى",
            "القسم الحيوانى",
            "قسم الثروه السمكيه",
        ];
        $category_descriptions = [
            "وصف القسم الزرارعى",
            "وصف القسم الحيوانى",
            "وصف قسم الثروه السمكيه",
        ];
        $category_keywords = [
            "كلمات القسم الزرارعى",
            "كلمات القسم الحيوانى",
            "كلمات قسم الثروه السمكيه",
        ];
        
        DB::table('categories')->delete();

        for ($i = 0; $i < $count ; $i++) {
            category::create([
                'name'          => $category_names[$i],
                'slug'          => str_replace(' ', '_',$category_names[$i]),
                'description'   => $category_descriptions[$i],
                'keyword'       => $category_keywords[$i],
                'department_id' => Department::all()->random()->id,
                
            ]);
        }
    }
}
