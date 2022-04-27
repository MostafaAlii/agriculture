<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class FarmerServiceAgri extends Model {
    use HasFactory;
    protected $table = "farmer_service_agris";
    public $timestamps = false;
}
