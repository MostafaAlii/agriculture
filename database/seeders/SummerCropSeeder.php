<?php
namespace Database\Seeders;
use App\Models\SummerCrop;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class SummerCropSeeder extends Seeder {
    public function run() {
        SummerCrop::factory()->count(3)->create();


    }
}
