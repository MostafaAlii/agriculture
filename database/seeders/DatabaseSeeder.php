<?php
namespace Database\Seeders;
use App\Models\{Blog, Brand,Image, Product, Slider, Farmer, User};
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run() {
        $count = 32;
        $this->call([
            PermissionTableSeeder::class,
//            CurrencySeeder::class,
//            CountrySeeder::class,
//            ProvinceSeeder::class,
//            AreaSeeder::class,
//            StateSeeder::class,
//            VillageSeeder::class,
//            DepartmentSeeder::class,
//            FarmerTableSeeder::class,
//            WorkerTableSeeder::class,
//            AdminDepartmentSeeder::class,
            AdminTableSeeder::class,
//            UserSeeder::class,
//            CategorySeeder::class,
            SettingSeeder::class,
//            TagSeeder::class,
//            BlogSeeder::class,
//            UnitSeeder::class,
//            ProductTableSeeder::class,
            SliderSeeder::class,
//            TreeTypeSeeder::class,
//            TreeSeeder::class,
//            LandCategorySeeder::class,
//            OrchardSeeder::class,
//            OrchardTreeSeeder::class,
//            ProtectedHouseSeeder::class,
//            AgriSeeder::class,
//            AgriToolSeeder::class,
//            WaterSeeder::class,
//            WholesaleSeeder::class,
//            FarmerServicesSeeder::class,
//            FarmerServiceAgriSeeder::class,
//            FarmerServiceAgriTSeeder::class,
//            FarmerServiceWaterSeeder::class,
//            PrecipitationSeeder::class,
//            LandAreaSeeder::class,
//            CawProjectSeeder::class,
//            ChickenProjectSeeder::class,
//            CourseBeeSeeder::class,
//            BeeDisasterSeeder::class,
//            BeeKeeperSeeder::class,
//            BeeKeeperCourseBeeSeeder::class,
//            BeeKeeperBeeDisasterSeeder::class,
//            WholeProductSeeder::class,
//            WholesaleSeeder::class,
//
//            OutcomeProductSeeder::class,
//            IncomeProductSeeder::class,
//            SummerCropSeeder::class,
//            WinterCropSeeder::class,
//            FarmerCropSeeder::class,
//            SummerCropFarmerCropSeeder::class,
//            WinterCropFarmerCropSeeder::class,
//            SubscriptionTableSeeder::class,
//            BrandSeeder::class,
//            AboutSeeder::class,
//            ReviewSeeder::class,
//            TeamSeeder::class,

        ]);

//        Farmer::factory(30)->create();
//        User::factory(30)->create();
//         // images
//         for ($i = 1; $i <= $count ; $i++) {
//            Image::insert([
//                'filename'     => rand(1,6) . ".jpg",
//                'imageable_id' => $i,
//                'imageable_type' => 'App\Models\User'
//            ]);
//        }
//           // images
//           for ($i = 1; $i <= $count ; $i++) {
//            Image::insert([
//                'filename'     => rand(1,6) . ".jpg",
//                'imageable_id' => $i,
//                'imageable_type' => 'App\Models\Farmer'
//            ]);
//        }


            // images
            for ($i = 1; $i <= $count ; $i++) {
                Image::insert([
                    'filename'     => rand(1,6) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Admin'
                ]);
            }
            // images for blog
//            for ($i = 1; $i <= Blog::count() ; $i++) {
//                Image::insert([
//                    'filename'     => 'blog-article-'.rand(1,5) . ".jpg",
//                    'imageable_id' => $i,
//                    'imageable_type' => 'App\Models\Blog'
//                ]);
//            }
            // images for slider
            for ($i = 1; $i <= Slider::count() ; $i++) {
                Image::insert([
                    'filename'     => rand(100,105) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Slider'
                ]);
            }
            // images for brand
//            for ($i = 1; $i <= Brand::count() ; $i++) {
//                Image::insert([
//                    'filename'     => 'brand'. rand(1,5) . ".jpg",
//                    'imageable_id' => $i,
//                    'imageable_type' => 'App\Models\Brand'
//                ]);
//            }
//            // images for product
//            for ($i = 1; $i <= Product::count() ; $i++) {
//                Image::insert([
//                    'filename'     => rand(1,73) . ".jpg",
//                    'imageable_id' => $i,
//                    'imageable_type' => 'App\Models\Product'
//                ]);
//            }
    }
}
