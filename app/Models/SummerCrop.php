<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class SummerCrop extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $table = "summer_crops";
    public $timestamps = true;
    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function farmer_crops()
    {
        return $this->belongsToMany( FarmerCrop::class,'summer_crop_farmer_crop','summer_crop_id',
            'farmer_crop_id');
    }

}