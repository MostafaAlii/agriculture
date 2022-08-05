<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BrandTranslation extends Model {
    protected $table = "brand_translations";
    protected $fillable = ['title'];
    public $timestamps = false;
}
