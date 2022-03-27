<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Slider extends Model {
    use HasFactory, Translatable;
    protected $table = "sliders";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'subtitle'];
    public $timestamps = true;

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}
