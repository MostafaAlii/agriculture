<?php
namespace App\Models;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Brand extends Model {
    use HasFactory , Translatable, HasImage;
    protected $table = "brands";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title'];
    public $timestamps = true;
    public $appends = ['image_path'];
}