<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Traits\HasImage;
class Slider extends Model {
    use HasFactory, Translatable, HasImage;
    protected $table = "sliders";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title', 'subtitle'];
    public $timestamps = true;
    public $appends = ['image_path'];
}