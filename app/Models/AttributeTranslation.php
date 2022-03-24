<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
class AttributeTranslation extends Model {
    use HasFactory,Translatable;
    
    protected $table = "attribute_translations";
    protected $guarded = [];
    public $translatedAttributes=[];
    public $timestamps = false;
}
