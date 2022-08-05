<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
class CourseBee extends Model {
    use HasFactory,Translatable;
    protected $table = "course_bees";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name','desc'];
    public $timestamps = true;
}
