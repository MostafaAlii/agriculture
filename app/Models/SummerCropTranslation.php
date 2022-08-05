<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class SummerCropTranslation extends Model {
    use HasFactory;
    protected $guarded = [];
    public $translatedAttributes = ['name'];
    protected $table = "summer_crop_translations";
    public $timestamps = false;
}
