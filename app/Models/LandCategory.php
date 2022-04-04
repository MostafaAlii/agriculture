<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class LandCategory extends Model {
    use HasFactory,Translatable;
    protected $table = "land_categories";
    protected $fillable = ['category_type'];
    protected $with = ['translations'];
    public $translatedAttributes = ['category_name'];

    public $timestamps = true;
}
