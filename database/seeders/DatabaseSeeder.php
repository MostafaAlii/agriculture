<?php
namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Country;
use App\Models\CountryTranslation;
use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDepartment;
use App\Models\Profile;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    public function run() {
        $count = 32;
        $this->call([
            CurrencySeeder::class,
            CountrySeeder::class,
            ProvinceSeeder::class,
            AreaSeeder::class,
            StateSeeder::class,
            VillageSeeder::class,
            DepartmentSeeder::class,
            FarmerTableSeeder::class,
            PaymentMethodSeeder::class,
            AdminTableSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            SettingSeeder::class,
            TagSeeder::class,
            BlogSeeder::class,
            AttributeTableSeeder::class,
            ProductTableSeeder::class,
            OptionTableSeeder::class,
            ProductCouponSeeder::class,
            SliderSeeder::class,
            UnitSeeder::class,
            supportedSideSeeder::class,
            TreeTypeSeeder::class,
            TreeSeeder::class,
            LandCategorySeeder::class,
            AdminDepartmentSeeder::class,
            OrchardSeeder::class,
            OrchardTreeSeeder::class,
            ProtectedHouseSeeder::class,
            AgriSeeder::class,
            AgriToolSeeder::class,
            WaterSeeder::class,
            FarmerServicesSeeder::class,
            FarmerServiceAgriSeeder::class,
            FarmerServiceAgriTSeeder::class,
            FarmerServiceWaterSeeder::class,
            PrecipitationSeeder::class,
            LandAreaSeeder::class,
            CawProjectSeeder::class,
            ChickenProjectSeeder::class,
            CourseBeeSeeder::class,
            BeeDisasterSeeder::class,
            BeeKeeperSeeder::class,
            BeeKeeperCourseBeeSeeder::class,
            BeeKeeperBeeDisasterSeeder::class,
            WholeProductSeeder::class,
            OutcomeProductSeeder::class,
            IncomeProductSeeder::class,
            CropSeeder::class,
            FarmerCropSeeder::class,
            CropFarmerCropSeeder::class,



        ]);

        \App\Models\Farmer::factory(30)->create();
        \App\Models\User::factory(30)->create();
         // images
         for ($i = 1; $i <= $count ; $i++) {
            Image::insert([
                'filename'     => rand(1,6) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\User'
            ]);
        }
           // images
           for ($i = 1; $i <= $count ; $i++) {
            Image::insert([
                'filename'     => rand(1,6) . ".jpg",
                'imageable_id' => $i,
                'imageable_type' => 'App\Models\Farmer'
            ]);
        }

            // images
            for ($i = 1; $i <= $count ; $i++) {
                Image::insert([
                    'filename'     => rand(1,6) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Admin'
                ]);
            }
            // images for blog
            for ($i = 1; $i <= Blog::count() ; $i++) {
                Image::insert([
                    'filename'     => 'blog-article-'.rand(1,5) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Blog'
                ]);
            }
            // images for slider
            for ($i = 1; $i <= Slider::count() ; $i++) {
                Image::insert([
                    'filename'     => rand(100,107) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Slider'
                ]);
            }
            // images for product
            for ($i = 1; $i <= Product::count() ; $i++) {
                Image::insert([
                    'filename'     => rand(1,67) . ".jpg",
                    'imageable_id' => $i,
                    'imageable_type' => 'App\Models\Product'
                ]);
            }
    }
}
