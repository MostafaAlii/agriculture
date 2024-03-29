<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LandCategoryTranslation extends Model {
    use HasFactory;
    protected $table = "land_category_translations";
    protected $guarded = [];
    public $translatedAttributes = ['category_name'];

    public $timestamps = false;
}
