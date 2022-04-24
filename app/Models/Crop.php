<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Crop extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $table = "crops";
    public $timestamps = true;
    protected $fillable = ['crop_type'];
    public $translatedAttributes = ['name'];

    public function farmer_crops()
    {
        return $this->belongsToMany( FarmerCrop::class,'crop_farmer_crops','crop_id',
            'farmer_crop_id')->withPivot('area');
    }

}