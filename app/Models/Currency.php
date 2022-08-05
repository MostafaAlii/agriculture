<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Currency extends Model {
    use HasFactory,Translatable;
    protected $table = "currencies";
    public $timestamps = true;
    protected $fillable = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['Name'];
}
