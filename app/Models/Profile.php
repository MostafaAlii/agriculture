<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Profile extends Model {
    use HasFactory,Translatable;
    protected $table = "profiles";
    protected $guarded = [];
    public $translatedAttributes = [];
    public $timestamps = true;
}
