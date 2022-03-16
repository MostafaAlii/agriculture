<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class VillageTranslation extends Model {
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;
}
