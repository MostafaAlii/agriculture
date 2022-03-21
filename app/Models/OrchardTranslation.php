<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class OrchardTranslation extends Model {
    use HasFactory,Translatable;
    protected $table = "orchard_translations";
    protected $fillable = ['village_id','farmer_id','admin_id','orchard_count','tree_count_per_orchard','orchard_area'];
    public $translatedAttributes = ['supported_side'];
    public $timestamps = false;
}
