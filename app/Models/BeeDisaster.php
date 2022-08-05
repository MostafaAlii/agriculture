<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class BeeDisaster extends Model {
    use HasFactory,Translatable;
    protected $table = "bee_disasters";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name','desc'];
    public $timestamps = true;

}
