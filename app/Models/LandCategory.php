<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class LandCategory extends Model {
    use HasFactory,Translatable;
    protected $table = "land_categories";
    protected $fillable = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['category_name','category_type'];

    public $timestamps = true;
}
