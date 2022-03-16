<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ProvinceTranslation extends Model {
    use HasFactory;
    protected $table = "province_translations";
    protected $fillable = ['name'];
    public $timestamps = false;
}
