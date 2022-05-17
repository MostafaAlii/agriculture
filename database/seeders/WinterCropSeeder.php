<?php
namespace Database\Seeders;
use App\Models\WinterCrop;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class WinterCropSeeder extends Seeder {
    public function run() {
        WinterCrop::factory()->count(30)->create();


    }
}
