<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Brand extends Model {
    use HasFactory , Translatable;
    protected $table = "brands";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['title'];
    public $timestamps = true;

    public function image() {
        return $this->morphOne(Image::class, 'imageable');
    }
}
