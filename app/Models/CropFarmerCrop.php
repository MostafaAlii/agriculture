<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CropFarmerCrop extends Model {
    use HasFactory;
    protected $table = "crop_farmer_crops";
    public $timestamps = false;
}
