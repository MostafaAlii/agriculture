<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class WaterServiceTranslation extends Model {
    use HasFactory;
    protected $fillable = ['name'];
    protected $table = "water_service_translations";
    public $timestamps = false;
}
