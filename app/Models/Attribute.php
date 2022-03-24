<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class Attribute extends Model {
    use HasFactory, Translatable;
    protected $table = "attributes";
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;
}