<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model {
    use HasFactory, Translatable;
    protected $table = "abouts";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title','description'];
    public $timestamps = true;

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}