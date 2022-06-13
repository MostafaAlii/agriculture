<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model {
    use HasFactory, Translatable;
    
    protected $table = "teams";
    protected $fillable = ['image'];
    protected $with = ['translations'];
    public $translatedAttributes = ['name','position','description'];
    public $timestamps = true;

}