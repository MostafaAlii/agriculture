<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
class Tag extends Model {
    use HasFactory, Translatable;
    protected $table = "tags";
    protected $guarded = [];
    protected $with = ['translations'];
    public $translatedAttributes = ['name'];
    public $timestamps = true;
}
