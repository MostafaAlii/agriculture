<?php
namespace Database\Seeders;
use App\Models\Crop;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
class CropSeeder extends Seeder {
    public function run() {
        Crop::factory()->count(30)->create();


    }
}
