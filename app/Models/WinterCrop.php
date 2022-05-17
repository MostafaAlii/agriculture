<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class WinterCrop extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $table = "winter_crops";
    public $timestamps = true;
    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function farmer_crops()
    {
        return $this->belongsToMany( FarmerCrop::class,'winter_crop_farmer_crop','winter_crop_id',
            'farmer_crop_id');
    }

}